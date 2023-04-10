@extends('layouts.dashboard')

@section('title')
Product
@endsection


@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update product</h1>
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
            <form action="{{ route('update_product', $editproduct->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Nama</label>
                    <input type="text" value="{{ $editproduct->name }}" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="title">Harga</label>
                    <input type="number" value="{{ $editproduct->price }}" class="form-control" name="price">
                </div>
                <div class="form-group">
                    <label for="title">Stok</label>
                    <input type="number" value="{{ $editproduct->stock }}" class="form-control" name="stock">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="blok w-full">{{ $editproduct->deskripsi }}</textarea>
                </div>
                <div class="form-group">
                    <label for="floatingInput">Sampul</label><br>
                    <small>Pilih gambar jika ingin mengubah</small>
                    <input value="{{ $editproduct->foto }}" type="file" class="form-control-file" id="floatingInput"
                        name="foto">
                    @if ( $editproduct->foto )
                    <img class="mt-3" width="100px" height="100px" src="{{ asset ('storage/'.$editproduct->foto) }}"
                        alt="fesfh">
                    @else
                    <p>Gambar Tidak Sedia</p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Update
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