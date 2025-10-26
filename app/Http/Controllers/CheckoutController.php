<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout dengan item yang dipilih (dari session) atau semua item dari keranjang.
     */
    public function index(Request $request)
    {
        $cartItems = collect();

        // Jika ada item khusus untuk di-checkout dari session (hasil dari "Beli Sekarang" atau "Checkout Pilihan")
        if ($request->session()->has('checkout_items')) {
            $checkoutItems = $request->session()->get('checkout_items');
            $productIds = array_keys($checkoutItems);
            $products = Product::findMany($productIds)->keyBy('id');

            foreach ($checkoutItems as $productId => $itemData) {
                if ($products->has($productId)) {
                    $product = $products[$productId];
                    // Buat instance CartItem sementara untuk ditampilkan di view
                    $cartItem = new CartItem($itemData);
                    $cartItem->setRelation('product', $product);
                    $cartItems->push($cartItem);
                }
            }
        } else {
            // Jika tidak, tampilkan semua item dari keranjang pengguna
            $cart = CartController::getCart();
            $cartItems = $cart->items()->with('product')->get();
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        return view('checkout.index', compact('cartItems'));
    }

    /**
     * Memproses pesanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Gunakan DB Transaction untuk memastikan semua proses berhasil atau dibatalkan jika ada error
        return DB::transaction(function () use ($request) {
            $cartItems = collect();
            $productIdsToRemove = [];

            // Proses item dari session jika ada
            if ($request->session()->has('checkout_items')) {
                $checkoutItems = $request->session()->get('checkout_items');
                $productIds = array_keys($checkoutItems);
                // Kunci baris produk yang akan diproses untuk menghindari race condition pada stok
                $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

                foreach ($checkoutItems as $productId => $itemData) {
                    if ($products->has($productId)) {
                        $product = $products[$productId];
                        // Cek stok sekali lagi sebelum membuat pesanan
                        if ($product->stock < $itemData['quantity']) {
                             return redirect()->route('cart.index')->with('error', 'Stok untuk produk ' . $product->name . ' tidak mencukupi.');
                        }
                        $cartItem = new CartItem($itemData);
                        $cartItem->setRelation('product', $product);
                        $cartItems->push($cartItem);
                        $productIdsToRemove[] = $productId;
                    }
                }
            } else {
                // Proses semua item dari keranjang
                $cart = CartController::getCart();
                $cartItems = $cart->items()->with('product')->get();
                 foreach($cartItems as $item) {
                     if ($item->product->stock < $item->quantity) {
                         return redirect()->route('cart.index')->with('error', 'Stok untuk produk ' . $item->product->name . ' tidak mencukupi.');
                     }
                }
                $productIdsToRemove = $cartItems->pluck('product_id')->all();
            }

            if ($cartItems->isEmpty()) {
                return redirect()->route('products.index')->with('error', 'Tidak ada produk untuk diproses checkout.');
            }

            $totalPrice = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            // 1. Buat Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_code' => 'ORD-' . strtoupper(Str::random(8)),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
            ]);

            // 2. Buat Order Items dan kurangi stok
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->price,
                ]);

                // Kurangi stok produk
                $item->product->decrement('stock', $item->quantity);
            }
            
            // 3. Buat catatan Pembayaran
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $totalPrice,
                'status' => 'pending',
            ]);

            // 4. Hapus item yang sudah dibeli dari keranjang
            $cart = CartController::getCart();
            if ($cart) {
                $cart->items()->whereIn('product_id', $productIdsToRemove)->delete();
            }

            // 5. Hapus data checkout dari session
            $request->session()->forget('checkout_items');

            return redirect()->route('home')->with('success', 'Pesanan Anda berhasil dibuat!');
        });
    }

    /**
     * Menangani logika "Beli Sekarang".
     */
    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = (int)$request->quantity;

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk pembelian langsung.');
        }

        // Simpan item ke session untuk di-checkout
        $checkoutItems = [
            $product->id => [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]
        ];
        $request->session()->put('checkout_items', $checkoutItems);

        return redirect()->route('checkout.index');
    }

    /**
     * Menangani logika "Checkout Pilihan".
     */
    public function checkoutSelected(Request $request)
    {
        $request->validate([
            'selected_products' => 'required|array',
            'selected_products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);
        
        $checkoutItems = [];
        $selectedProducts = Product::findMany($request->selected_products)->keyBy('id');

        foreach ($request->selected_products as $productId) {
            $quantity = (int)($request->quantities[$productId] ?? 0);

            if ($quantity > 0 && $selectedProducts->has($productId)) {
                $product = $selectedProducts[$productId];
                if ($product->stock < $quantity) {
                    return redirect()->back()->with('error', 'Stok untuk produk ' . $product->name . ' tidak mencukupi.');
                }

                $checkoutItems[$productId] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ];
            }
        }

        if (empty($checkoutItems)) {
            return redirect()->back()->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
        }

        $request->session()->put('checkout_items', $checkoutItems);

        return redirect()->route('checkout.index');
    }
}