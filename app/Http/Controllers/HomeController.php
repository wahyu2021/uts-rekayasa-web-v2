<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->latest()->take(4)->get();
        $categories = Category::all();

        return view('home', compact('featuredProducts', 'categories'));
    }
}
