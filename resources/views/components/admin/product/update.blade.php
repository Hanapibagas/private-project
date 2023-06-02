@extends('layouts.admin')

@section('title')
Berita
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update product</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('update_product', $product->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
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
                                <img src="{{ Storage::disk('public')->exists($product->photo) ? Storage::url($product->photo) : url('assets/img/image_not_available.png') }}"
                                    class="rounded img-responsive" alt="{{ $product->name }}" width="100%"
                                    id="img-preview">
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
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
                                    <input type="text" class="form-control" name="product_code"
                                        value="{{ $product->product_code }}">
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
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                    </div>
                                    <select class="form-control" name="category_id">
                                        @foreach ($category as $category)
                                        <option value="">{{ $category->name }}</option>
                                        <option value="">-- Silahkan Ubah --</option>
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
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
                                    <input type="number" class="form-control currency" name="stock"
                                        value="{{ $product->stock }}">
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
                                    <input type="text" class="form-control currency" name="purchase_price"
                                        value="{{ $product->purchase_price }}">
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
                                    <input type="text" class="form-control currency" name="selling_price"
                                        value="{{ $product->selling_price }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-10 offset-2">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi">{!! $product->deskripsi !!}</textarea>
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
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>
<script src="{{ url('assets/backend/js/image_upload.js') }}"></script>
@endpush