<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        try {
            $quantity = $request->input('quantity', 1);

            // Basic validation for quantity
            if (!is_numeric($quantity) || $quantity < 1) {
                return response()->json(['success' => false, 'message' => 'Invalid quantity provided.'], 400);
            }

            // Check if product stock is sufficient
            if ($product->stock < $quantity) {
                return response()->json(['success' => false, 'message' => 'Not enough stock available.'], 400);
            }

            $cart = session()->get('cart', []);

            if(isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
            } else {
                $cart[$product->id] = [
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "image" => $product->image_path,
                    "slug" => $product->slug // Add slug for potential future use
                ];
            }

            session()->put('cart', $cart);

            return response()->json(['success' => true, 'message' => 'Product added to cart successfully!']);

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
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

            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                if ($product->stock < $quantity) {
                    return response()->json(['success' => false, 'message' => 'Not enough stock available.'], 400);
                }
                $cart[$product->id]['quantity'] = $quantity;
                session()->put('cart', $cart);

                return response()->json(['success' => true, 'message' => 'Cart updated successfully!']);
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
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                unset($cart[$product->id]);
                session()->put('cart', $cart);

                return response()->json(['success' => true, 'message' => 'Product removed from cart successfully!']);
            }

            return response()->json(['success' => false, 'message' => 'Product not found in cart.'], 404);

        } catch (\Exception $e) {
            Log::error('Error removing product from cart: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }
}
