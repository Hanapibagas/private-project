@extends('layouts.admin')

@section('title')
Product
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah product</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('store_gallery') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Product</label>
                    <select name="product_id" class="form-control">
                        <option value="">-- Silahkan Pilih --</option>
                        @foreach ( $product as $files )
                        <option value="{{ $files->id }}">
                            {{ $files->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Gambar</label>
                    <input type="file" placeholder="Masukkan kode barang"
                        class="form-control-file @error('name') is-invalid @enderror" name="name[]" multiple="multiple">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Tambah kategori
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