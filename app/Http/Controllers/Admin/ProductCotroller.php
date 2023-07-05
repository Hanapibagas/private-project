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
        $categories = ProductCategory::all();
        return view('components.admin.product.create', compact('categories'));
    }

    public function store_product(Request $request)
    {
        $message = [
            'required' => 'Mohon maaf anda lupa untuk mengisi ini dan harap anda mangisi terlebih dahulu'
        ];

        $this->validate($request, [
            'photo' => 'required',
            'name' => 'required',
            'deskripsi' => 'required',
            'selling_price' => 'required',
            'purchase_price' => 'required',
            'stock' => 'required',
        ], $message);

        if ($request->file('photo')) {
            $file = $request->file('photo')->store('photo-product', 'public');
        }

        Product::create([
            'photo' => $file,
            'name' => $request->input('name'),
            'deskripsi' => $request->input('deskripsi'),
            'selling_price' => str_replace(',', '', $request['purchase_price']),
            'purchase_price' => str_replace(',', '', $request['selling_price']),
            'stock' => $request->input('stock'),
            'product_code' => $request->input('product_code'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('index_product')->with('status', 'Selamat data product berhasil ditambahkan');
    }

    public function edit_product(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $categories = ProductCategory::all();
        return view('components.admin.product.update', compact('product', 'categories'));
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
