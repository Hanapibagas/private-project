<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index_category()
    {
        $category = ProductCategory::all();
        return view('components.admin.category.index', compact('category'));
    }
}
