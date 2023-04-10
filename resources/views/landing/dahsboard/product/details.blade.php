@extends('layouts.dashboard')

@section('title')
Product
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Detail Transaksi {{ $details_product->name }}</h1>
        <span style="float: right;">
            <a href="{{ route('index_product') }}" class="btn btn-sm btn-primary"><i class="fa fa-undo"></i> kembali</a>
        </span>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Product</th>
                    <td>{{ $details_product->name }}</td>
                </tr>
                <tr>
                    <th>Harga Product</th>
                    <td>Rp.{{ $details_product->price }}</td>
                </tr>
                <tr>
                    <th>Stok Product</th>
                    <td>{{ $details_product->stock }}</td>
                </tr>
                <tr>
                    <th>Gambar Product</th>
                    <td>
                        <img src="{{ asset('storage/'.$details_product->foto) }}" alt="" style="width: 150px"
                            class="img-thumbnail">
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi Product</th>
                    <td>{!! $details_product->deskripsi !!}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection