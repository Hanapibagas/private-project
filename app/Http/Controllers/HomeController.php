<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = ProductGallery::paginate(4);
        $kategory = ProductCategory::all();
        return view('components.pages.home', compact('product', 'kategory'));
    }

    public function category()
    {
        return view('components.pages.category');
    }
}
