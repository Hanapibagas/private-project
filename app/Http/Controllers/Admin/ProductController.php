<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index_product()
    {
        $products = Product::all();
        return view('landing.dahsboard.product.index', compact('products'));
    }

    public function create_product()
    {
        return view('landing.dahsboard.product.create');
    }

    public function store_product(Request $request)
    {
        $this->validate($request, [
            "name" => 'required',
            "price" => 'required',
            "stock" => 'required',
            "deskripsi" => 'required'
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto')->store('gallery', 'public');
        }

        $slug = Str::slug($request->name);
        Product::create([
            "name" => $request->input('name'),
            "price" => $request->input('price'),
            "stock" => $request->input('stock'),
            "slug" => $slug,
            "foto" => $file,
            "deskripsi" => $request->input('deskripsi')
        ]);

        return redirect()->route('index_product')->with('status', 'Selamat data product berhasil terinput');
    }

    public function edit_product(Request $request, $id)
    {
        $editproduct = Product::where('id', $id)->first();
        return view('landing.dahsboard.product.update', compact('editproduct'));
    }

    public function update_product(Request $request, $id)
    {
        $editproduct = Product::where('id', $id)->first();

        if ($request->file('foto')) {
            $file = $request->file('foto')->store('gallery', 'public');
            if ($editproduct->foto && file_exists(storage_path('app/public/' . $editproduct->foto))) {
                Storage::delete('public/' . $editproduct->foto);
                $file = $request->file('foto')->store('gallery', 'public');
            }
        }

        if ($request->file('foto') === null) {
            $file = $editproduct->foto;
        }

        $slug = Str::slug($request->name);
        $editproduct->update([
            "name" => $request->input('name'),
            "price" => $request->input('price'),
            "stock" => $request->input('stock'),
            "slug" => $slug,
            "foto" => $file,
            "deskripsi" => $request->input('deskripsi')
        ]);

        return redirect()->route('index_product')->with('status', 'Selamat data product berhasil diperbarui');
    }

    public function destroy_product($id)
    {
        $delete = Product::find($id);

        $delete->delete();

        return response()->json(['status' => 'Mahasiswa Berhasil di hapus!']);
    }

    public function details_product($id)
    {
        $details_product = Product::findOrFail($id);
        return view('landing.dahsboard.product.details', compact('details_product'));
    }
}
