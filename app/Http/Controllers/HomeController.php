<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('images', 'category')
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::all();

        return view('store.index', compact('featuredProducts', 'categories'));
    }
}
