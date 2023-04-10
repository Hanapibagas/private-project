@extends('layouts.dashboard')

@section('title')
Product
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah prduct</h1>
        <span style="float: right;">
            <a href="{{ route('index_product') }}" class="btn btn-sm btn-primary"><i class="fa fa-undo"></i> kembali</a>
        </span>
    </div>

    @if ( $errors->any() )
    <div class="alert alert-danger">
        <ul>
            @foreach ( $errors->all() as $error )
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama Product">
                </div>
                <div class="form-group">
                    <label for="title">Harga</label>
                    <input type="number" class="form-control" name="price" placeholder="Harga Product">
                </div>
                <div class="form-group">
                    <label for="title">Stok</label>
                    <input type="number" class="form-control" name="stock" placeholder="Stok Product">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="blok w-full"></textarea>
                </div>
                <div class="form-group">
                    <label for="title">Foto</label>
                    <input type="file" class="form-control-file" name="foto">
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Kirim
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('add-script')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
@endpush