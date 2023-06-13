@extends('layouts.app')

@section('content')
<div class="page-content page-cart">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                My Transaksi
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                Daftar Belanja
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="saleTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Transaksi kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Diskon</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $transaksi as $key => $items )
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <th>{{ $items->transaction_code }}</th>
                                <th>{{ $items->user->name }}</th>
                                <th>{{ $items->discount }}</th>
                                <th>{{ $items->sub_total }}</th>
                                <th>
                                    <span class="badge badge-{{ $items->status == 1 ? 'success' : 'secondary'}}">
                                        {{ $items->status == 1 ? 'Sudah di proses' : 'Sedang di proses'}}
                                    </span>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection