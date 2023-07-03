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
                                <th scope="col">Nama Akun</th>
                                <th scope="col">Metode Pembayaran</th>
                                <th scope="col">Status</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $transaksi as $key => $items )
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <th>{{ $items->user->name }}</th>
                                <th>{{ $items->metode_pembayaran }}</th>
                                <th>
                                    <span class="badge badge-{{ $items->status == 1 ? 'success' : 'secondary'}}">
                                        {{ $items->status == 1 ? 'Sudah di proses' : 'Sedang di proses'}}
                                    </span>
                                </th>
                                <th>
                                    <button class="btn btn-success btn-icon icon-left" data-toggle="modal"
                                        data-target="#editItem-{{ $items->id }}">
                                        <i class="fas fa-eye-slash"></i> Details
                                    </button>
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

@foreach ($transaksi as $item)
<div class="modal fade" tabindex="-1" role="dialog" id="editItem-{{ $item->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('getUpdateCart', $item->id  ) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ $item->nama_lengkap }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap :</label>
                        <h7 class="modal-title">{{ $item->nama_lengkap }}</h7>
                    </div>
                    <div class="form-group">
                        <label>Diskon :</label>
                        <h7 class="modal-title">{{ $item->discount }}%</h7>
                    </div>
                    <div class="form-group">
                        <label>Potongan Diskon :</label>
                        <h7 class="modal-title">Rp.{{ number_format($item->discount_price) }}</h7>
                    </div>
                    <div class="form-group">
                        <label>Total :</label>
                        <h7 class="modal-title">Rp.{{ number_format($item->grand_total) }}</h7>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
