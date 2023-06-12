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
            <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{ $error }}
                        </div>
                    </div>
                    @endforeach
                    @endif

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="">Pratinjau Foto</label>
                                <img src="{{ url('assets/backend/img/image_not_available.png') }}"
                                    class="rounded img-responsive" alt="Image Preview" width="100%" id="img-preview">
                            </div>
                            <div class="form-group">
                                <label class="float-right">
                                    <a href="#" data-toggle="tooltip"
                                        title="Klik untuk menghapus foto yang sudah dipilih" style="display:none"
                                        id="img-reset">
                                        <code class="text-right">Hapus Foto</code>
                                    </a>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-file-image"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="photo" id="img-file">
                                        <label class="custom-file-label" id="img-name">Pilih Foto</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Kode Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control @error('product_code') is-invalid @enderror"
                                        name="product_code" value="{{ old('product_code') }}">
                                    @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-pencil-alt"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kategori <br />
                                    @if ($category->isEmpty())
                                    <code>Belum ada kategori klik <a href="{{ route('create_cataegory') }}">disini</a> untuk menambah kategori.</code>
                                    @endif
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                    </div>
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                        @foreach ($category as $category)
                                        <option value="">-- Silahkan Pilih --</option>
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Stok</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                    </div>
                                    <input type="number" class="form-control currency" name="stock">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    Harga Beli
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <b>Rp</b>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control currency" name="purchase_price">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    Harga Jual
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <b>Rp</b>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control currency" name="selling_price">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-10 offset-2">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ url('assets/backend/js/cleave.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
<script src="{{ url('assets/backend/js/image_upload.js') }}"></script>
<script src="{{ url('assets/backend/js/my_cleave.js') }}"></script>
@endpush