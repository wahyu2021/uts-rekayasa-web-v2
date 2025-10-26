<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Start the query
        $query = Product::query();

        // Handle category filtering
        if ($request->has('categories') && is_array($request->categories)) {
            $selectedCategories = array_filter($request->categories);
            if (!empty($selectedCategories)) {
                $query->whereHas('category', function ($q) use ($selectedCategories) {
                    $q->whereIn('slug', $selectedCategories);
                });
            }
        }

        // Fetch products with pagination
        $products = $query->latest()->paginate(5)->withQueryString(); // withQueryString appends filters to pagination links

        $categories = Category::all();

        return view('products', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories ?? [] // Pass selected filters back to the view
        ]);
    }
}
