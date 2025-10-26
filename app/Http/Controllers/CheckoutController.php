<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product; // Import Product model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; // Import Log facade

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        if (session()->has('buy_now_item')) {
            $cart = [session('buy_now_item')['id'] => session('buy_now_item')];
        } elseif (session()->has('selected_cart_items')) {
            $cart = session('selected_cart_items');
        } else {
            $cart = session()->get('cart', []);
        }
        return view('checkout.index', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $cartToProcess = [];
        $isBuyNow = false;
        $isSelectedCart = false;

        if (session()->has('buy_now_item')) {
            $cartToProcess = [session('buy_now_item')['id'] => session('buy_now_item')];
            $isBuyNow = true;
        } elseif (session()->has('selected_cart_items')) {
            $cartToProcess = session('selected_cart_items');
            $isSelectedCart = true;
        } else {
            $cartToProcess = session()->get('cart', []);
        }

        if (empty($cartToProcess)) {
            return redirect()->route('products.index')->with('error', 'Tidak ada produk untuk diproses checkout.');
        }

        $totalPrice = 0;
        foreach ($cartToProcess as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Create Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
        ]);

        // Create Order Items
        foreach ($cartToProcess as $productId => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $details['quantity'],
                'unit_price' => $details['price'],
            ]);
        }
        
        // Create Payment
        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'amount' => $totalPrice,
            'status' => 'pending',
        ]);

        // Handle cart clearing based on the checkout type
        if ($isBuyNow) {
            session()->forget('buy_now_item'); // Clear flash data
        } elseif ($isSelectedCart) {
            $currentCart = session()->get('cart', []);
            foreach ($cartToProcess as $productId => $details) {
                if (isset($currentCart[$productId])) {
                    unset($currentCart[$productId]);
                }
            }
            session()->put('cart', $currentCart);
            session()->forget('selected_cart_items'); // Clear flash data
        } else {
            // Regular checkout, clear entire cart
            session()->forget('cart');
        }

        return redirect()->route('home')->with('success', 'Pesanan Anda berhasil dibuat!');
    }

    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        // Check if product stock is sufficient
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available for direct purchase.');
        }

        $buyNowItem = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $quantity,
            'price' => $product->price,
            'image' => $product->image_path,
            'slug' => $product->slug,
        ];

        // Store the single item in session flash for the next request
        session()->flash('buy_now_item', $buyNowItem);

        return redirect()->route('checkout.index');
    }

    public function checkoutSelected(Request $request)
    {
        Log::info('checkoutSelected method called.');
        Log::info('Request data: ' . json_encode($request->all()));

        $request->validate([
            'selected_products' => 'required|array',
            'selected_products.*' => 'exists:products,id', // Ensure all selected product IDs exist
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        Log::info('Validation passed.');

        $selectedItems = [];
        $cart = session()->get('cart', []); // Get the full cart to retrieve product details

        Log::info('Current session cart: ' . json_encode($cart));

        foreach ($request->selected_products as $productId) {
            $quantity = $request->quantities[$productId] ?? 0;

            Log::info("Processing product ID: {$productId}, Quantity: {$quantity}");

            if ($quantity > 0 && isset($cart[$productId])) {
                $productData = $cart[$productId];
                // Ensure stock is sufficient (optional, but good practice)
                // if ($productData['stock'] < $quantity) {
                //     return redirect()->back()->with('error', 'Not enough stock for one of the selected products.');
                // }

                $selectedItems[$productId] = [
                    'id' => $productId,
                    'name' => $productData['name'],
                    'quantity' => $quantity,
                    'price' => $productData['price'],
                    'image' => $productData['image'],
                    'slug' => $productData['slug'] ?? null,
                ];
                Log::info("Added product {$productId} to selectedItems.");
            } else {
                Log::warning("Product {$productId} not found in session cart or quantity is zero/invalid.");
            }
        }

        Log::info('Final selectedItems: ' . json_encode($selectedItems));

        if (empty($selectedItems)) {
            Log::warning('No products selected for checkout after processing.');
            return redirect()->back()->with('error', 'No products selected for checkout.');
        }

        session()->flash('selected_cart_items', $selectedItems);
        Log::info('selected_cart_items flashed to session.');

        return redirect()->route('checkout.index');
    }
}