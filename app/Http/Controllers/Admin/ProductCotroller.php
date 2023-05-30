<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCotroller extends Controller
{
    public function index_product()
    {
        $product = Product::all();
        return view('components.admin.product.index', compact('product'));
    }

    public function create_product()
    {
        $category = ProductCategory::all();
        return view('components.admin.product.create', compact('category'));
    }

    public function store_product(Request $request)
    {
        // dd($request->all());
        $message = [
            'required' => 'Mohon maaf anda lupa untuk mengisi ini dan harap anda mangisi terlebih dahulu'
        ];

        $this->validate($request, [
            'product_code' => 'required',
            'name' => 'required',
            'selling_price' => 'required',
            'purchase_price' => 'required',
            'stock' => 'required',
            'deskripsi' => 'required',
        ], $message);

        $slug = Str::slug($request->name);
        Product::create([
            'product_code' => $request->input('product_code'),
            'name' => $request->input('name'),
            'slug' => $slug,
            'selling_price' => $request->input('selling_price'),
            'purchase_price' => $request->input('purchase_price'),
            'stock' => $request->input('stock'),
            'deskripsi' => $request->input('deskripsi'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('index_product')->with('status', 'Selamat data product berhasil ditambahkan');
    }

    public function edit_product(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $category = ProductCategory::all();
        return view('components.admin.product.update', compact('product', 'category'));
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();

        $product->update([
            'product_code' => $request->input('product_code'),
            'deskripsi' => $request->input('deskripsi'),
            'name' => $request->input('name'),
            'selling_price' => $request->input('selling_price'),
            'purchase_price' => $request->input('purchase_price'),
            'stock' => $request->input('stock'),
            'category_id' => $request->input('category_id')
        ]);

        return redirect()->route('index_product')->with('status', 'Selamat data product berhasil diperbarui');
    }

    public function destroy_product($id)
    {
        $delete = Product::find($id);
        $delete->delete();
        return response()->json(['status' => 'Selamat data product berhasil dihapus']);
    }
}
