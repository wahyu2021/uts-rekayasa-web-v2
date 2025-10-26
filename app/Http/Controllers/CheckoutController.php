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
use App\Http\Controllers\CartController; // Import CartController

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cart = CartController::getCart();
        $cartItems = $cart->items()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', compact('cartItems'));
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

        $cart = CartController::getCart();
        $cartItems = $cart->items()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Tidak ada produk untuk diproses checkout.');
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->price * $item->quantity;
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
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->price,
            ]);

            // Optionally decrement product stock
            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
        }
        
        // Create Payment
        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'amount' => $totalPrice,
            'status' => 'pending',
        ]);

        // Clear the cart after successful checkout
        $cart->items()->delete();
        $cart->delete(); // Delete the cart itself if it's empty or no longer needed

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

        // Get the current user's or guest's cart
        $cart = CartController::getCart();

        // Clear existing items in the cart for 'Buy Now'
        $cart->items()->delete();

        // Add the 'Buy Now' product to the cart
        $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price, // Store current price
        ]);

        return redirect()->route('checkout.index');
    }

    public function checkoutSelected(Request $request)
    {
        $request->validate([
            'selected_products' => 'required|array',
            'selected_products.*' => 'exists:products,id', // Ensure all selected product IDs exist
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        $cart = CartController::getCart();

        // Clear existing items in the cart for selected checkout
        $cart->items()->delete();

        foreach ($request->selected_products as $productId) {
            $quantity = $request->quantities[$productId] ?? 0;

            if ($quantity > 0) {
                $product = Product::findOrFail($productId);
                // Check if product stock is sufficient
                if ($product->stock < $quantity) {
                    return redirect()->back()->with('error', 'Not enough stock for one of the selected products.');
                }

                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
            }
        }

        if ($cart->items()->count() === 0) {
            return redirect()->back()->with('error', 'No products selected for checkout.');
        }

        return redirect()->route('checkout.index');
    }
}