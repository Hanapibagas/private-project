<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function category()
    {
        $kategory = ProductCategory::all();
        $product = Product::all();
        return view('components.pages.category', compact('kategory', 'product'));
    }

    public function details_products(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('components.pages.details', compact('product'));
    }

    public function cart()
    {
        return view('components.pages.cart');
    }
}
