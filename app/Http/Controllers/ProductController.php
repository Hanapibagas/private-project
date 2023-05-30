<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function category()
    {
        $kategory = ProductCategory::all();
        $product = ProductGallery::all();
        return view('components.pages.category', compact('kategory', 'product'));
    }
}
