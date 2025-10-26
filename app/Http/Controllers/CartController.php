<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Get the current user's cart or create a new one.
     * For guests, it uses the session ID.
     */
    public static function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            $sessionId = session()->getId();
            return Cart::firstOrCreate(['session_id' => $sessionId]);
        }
    }

    public function add(Request $request, Product $product)
    {
        try {
            $quantity = $request->input('quantity', 1);
            Log::info('Received quantity for add to cart: ' . $quantity);
            $buyNow = $request->boolean('buy_now', false);

            // Basic validation for quantity
            if (!is_numeric($quantity) || $quantity < 1) {
                return response()->json(['success' => false, 'message' => 'Invalid quantity provided.'], 400);
            }

            // Check if product stock is sufficient
            if ($product->stock < $quantity) {
                return response()->json(['success' => false, 'message' => 'Not enough stock available.'], 400);
            }

            $cart = $this->getCart();

            if ($buyNow) {
                // For 'Buy Now', clear existing cart items and add only this product
                $cart->items()->delete(); // Clear all items from the cart
                $cartItem = $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
            } else {
                // For regular 'Add to Cart'
                $cartItem = $cart->items()->where('product_id', $product->id)->first();

                if ($cartItem) {
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                } else {
                    $cart->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ]);
                }
            }

            $cart->refresh(); // Refresh the cart to reload its items relationship

            // Update cart_count for frontend if needed
            $cartCount = $cart->items()->sum('quantity');
            Log::info('Cart items after add: ' . $cart->items()->count());
            Log::info('Calculated cart count: ' . $cartCount);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $cartCount
            ]);

        } catch (\Exception $e) {
            Log::error('Error adding product to cart: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }

    public function update(Request $request, Product $product)
    {
        try {
            $quantity = $request->input('quantity');

            if (!is_numeric($quantity) || $quantity < 1) {
                return response()->json(['success' => false, 'message' => 'Invalid quantity provided.'], 400);
            }

            $cart = $this->getCart();
            $cartItem = $cart->items()->where('product_id', $product->id)->first();

            if ($cartItem) {
                if ($product->stock < $quantity) {
                    return response()->json(['success' => false, 'message' => 'Not enough stock available.'], 400);
                }
                $cartItem->quantity = $quantity;
                $cartItem->save();

                // Update cart_count for frontend if needed
                $cartCount = $cart->items()->sum('quantity');

                return response()->json([
                    'success' => true,
                    'message' => 'Cart updated successfully!',
                    'cart_count' => $cartCount
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Product not found in cart.'], 404);

        } catch (\Exception $e) {
            Log::error('Error updating product in cart: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }

    public function remove(Product $product)
    {
        try {
            $cart = $this->getCart();
            $cartItem = $cart->items()->where('product_id', $product->id)->first();

            if ($cartItem) {
                $cartItem->delete();

                // Update cart_count for frontend if needed
                $cartCount = $cart->items()->sum('quantity');

                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from cart successfully!',
                    'cart_count' => $cartCount
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Product not found in cart.'], 404);

        } catch (\Exception $e) {
            Log::error('Error removing product from cart: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }

    public function index()
    {
        $cart = $this->getCart();
        $cartItems = $cart->items()->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function checkout()
    {
        $cart = $this->getCart();
        $cartItems = $cart->items()->with('product')->get();
        return view('checkout.index', compact('cartItems'));
    }
}
