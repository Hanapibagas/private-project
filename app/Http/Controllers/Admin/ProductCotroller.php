<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
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

    public function store_product(ProductRequest $request)
    {
        $photo = $request->file('photo');

        $data = $request->all();

        if ($photo) {
            $data['photo'] = $photo->store(
                'assets/product',
                'public'
            );
        } else {
            $data['photo'] = "";
        }

        $data['purchase_price'] = str_replace(',', '', $data['purchase_price']);
        $data['selling_price'] = str_replace(',', '', $data['selling_price']);

        Product::create($data);

        return redirect()->route('index_product')->with('status', 'Selamat data product berhasil ditambahkan');
    }

    public function edit_product(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $category = ProductCategory::all();
        return view('components.admin.product.update', compact('product', 'category'));
    }

    public function update_product(ProductRequest $request, $id)
    {
        $photo = $request->file('photo');

        $data = $request->all();
        $data['purchase_price'] = str_replace(',', '', $data['purchase_price']);
        $data['selling_price'] = str_replace(',', '', $data['selling_price']);

        if ($photo) {
            $data['photo'] = $photo->store(
                'assets/product',
                'public'
            );
        }

        Product::findOrFail($id)->update($data);

        return redirect()->route('index_product')->with('status', 'Selamat data product berhasil diperbarui');
    }

    public function destroy_product($id)
    {
        $delete = Product::find($id);
        $delete->delete();
        return response()->json(['status' => 'Selamat data product berhasil dihapus']);
    }
}
