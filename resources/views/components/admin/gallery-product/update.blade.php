@extends('layouts.admin')

@section('title')
Berita
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update kategori</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('update_product', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Kode product</label>
                    <input type="text" value="{{ $product->product_code }}" placeholder="Masukkan kode barang"
                        class="form-control @error('product_code') is-invalid @enderror" name="product_code">
                    @error('product_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Nama product</label>
                    <input type="text" value="{{ $product->name }}" placeholder="Masukkan nama product"
                        class="form-control @error('name') is-invalid @enderror" name="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Harga jual</label>
                    <input type="number" value="{{ $product->selling_price }}" placeholder="Masukkan harga jual barang"
                        class="form-control @error('selling_price') is-invalid @enderror" name="selling_price">
                    @error('selling_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Harga beli</label>
                    <input type="number" value="{{ $product->purchase_price }}" placeholder="Masukkan harga beli barang"
                        class="form-control @error('purchase_price') is-invalid @enderror" name="purchase_price">
                    @error('purchase_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Stok barang</label>
                    <input type="number" value="{{ $product->stock }}" placeholder="Masukkan stok barang"
                        class="form-control @error('stock') is-invalid @enderror" name="stock">
                    @error('stock')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Deskripsi barang</label>
                    <textarea name="deskripsi"
                        class="blok w-full @error('deskripsi') is-invalid @enderror">{!! $product->deskripsi !!}</textarea>
                    @error('deskripsi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Kategori</label>
                    <select name="category_id" class="form-control">
                        <option value="">-- Pili kategori --</option>
                        @foreach ( $category as $files )
                        <option value="{{ $files->id }}">
                            {{ $files->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Update kategori
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
@endpush