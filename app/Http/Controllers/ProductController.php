<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk dengan filter dan paginasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('categories') && is_array($request->categories)) {
            $selectedCategories = array_filter($request->categories);
            if (! empty($selectedCategories)) {
                $query->whereHas('category', function ($q) use ($selectedCategories) {
                    $q->whereIn('slug', $selectedCategories);
                });
            }
        }

        $products = $query->latest()->paginate(5)->withQueryString();

        $categories = Category::all();

        return view('products', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories ?? [], // Pass selected filters back to the view
        ]);
    }

    /**
     * Menampilkan detail dari produk yang spesifik.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
