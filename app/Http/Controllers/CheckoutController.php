<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     *
     * Method ini menampilkan item yang akan di-checkout. Logikanya bercabang:
     * 1. Jika ada item di dalam session ('checkout_items'), item tersebut yang akan ditampilkan (untuk alur "Beli Sekarang" atau "Checkout Pilihan").
     * 2. Jika tidak, semua item dari keranjang belanja pengguna saat ini akan ditampilkan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $cartItems = collect();

        if ($request->session()->has('checkout_items')) {
            $checkoutItems = $request->session()->get('checkout_items');
            $productIds = array_keys($checkoutItems);
            $products = Product::findMany($productIds)->keyBy('id');

            foreach ($checkoutItems as $productId => $itemData) {
                if ($products->has($productId)) {
                    $product = $products[$productId];
                    $cartItem = new CartItem($itemData);
                    $cartItem->setRelation('product', $product);
                    $cartItems->push($cartItem);
                }
            }
        } else {
            $cart = CartController::getCart();
            $cartItems = $cart->items()->with('product')->get();
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        return view('checkout.index', compact('cartItems'));
    }

    /**
     * Memvalidasi dan menyimpan pesanan baru ke dalam database.
     *
     * Method ini berjalan di dalam sebuah database transaction. Langkah-langkahnya adalah:
     * 1. Mengambil item dari session atau keranjang.
     * 2. Memvalidasi stok produk.
     * 3. Membuat record 'Order' baru.
     * 4. Membuat record 'OrderItem' untuk setiap produk dan mengurangi stok.
     * 5. Membuat record 'Payment'.
     * 6. Menghapus item yang sudah di-checkout dari keranjang.
     * 7. Menghapus data checkout dari session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        return DB::transaction(function () use ($request) {
            $cartItems = collect();
            $productIdsToRemove = [];

            if ($request->session()->has('checkout_items')) {
                $checkoutItems = $request->session()->get('checkout_items');
                $productIds = array_keys($checkoutItems);
                $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

                foreach ($checkoutItems as $productId => $itemData) {
                    if ($products->has($productId)) {
                        $product = $products[$productId];
                        if ($product->stock < $itemData['quantity']) {
                            return redirect()->route('cart.index')->with('error', 'Stok untuk produk '.$product->name.' tidak mencukupi.');
                        }
                        $cartItem = new CartItem($itemData);
                        $cartItem->setRelation('product', $product);
                        $cartItems->push($cartItem);
                        $productIdsToRemove[] = $productId;
                    }
                }
            } else {
                $cart = CartController::getCart();
                $cartItems = $cart->items()->with('product')->get();
                foreach ($cartItems as $item) {
                    if ($item->product->stock < $item->quantity) {
                        return redirect()->route('cart.index')->with('error', 'Stok untuk produk '.$item->product->name.' tidak mencukupi.');
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

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_code' => 'ORD-'.strtoupper(Str::random(8)),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $totalPrice,
                'status' => 'pending',
            ]);

            $cart = CartController::getCart();
            if ($cart) {
                $cart->items()->whereIn('product_id', $productIdsToRemove)->delete();
            }

            $request->session()->forget('checkout_items');

            return redirect()->route('home')->with('success', 'Pesanan Anda berhasil dibuat!');
        });
    }

    /**
     * Menangani logika "Beli Sekarang".
     *
     * Method ini mengambil satu produk dan kuantitasnya, menyimpannya ke dalam session
     * sebagai item yang akan di-checkout, lalu mengarahkan pengguna ke halaman checkout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = (int) $request->quantity;

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk pembelian langsung.');
        }

        $checkoutItems = [
            $product->id => [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ],
        ];
        $request->session()->put('checkout_items', $checkoutItems);

        return redirect()->route('checkout.index');
    }

    /**
     * Menangani logika "Checkout Pilihan" dari halaman keranjang.
     *
     * Method ini mengambil produk dan kuantitas yang dipilih pengguna dari form keranjang,
     * memvalidasinya, menyimpannya ke dalam session, lalu mengarahkan ke halaman checkout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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
            $quantity = (int) ($request->quantities[$productId] ?? 0);

            if ($quantity > 0 && $selectedProducts->has($productId)) {
                $product = $selectedProducts[$productId];
                if ($product->stock < $quantity) {
                    return redirect()->back()->with('error', 'Stok untuk produk '.$product->name.' tidak mencukupi.');
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
