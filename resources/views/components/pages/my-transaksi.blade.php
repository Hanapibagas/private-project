@extends('layouts.app')

@section('content')
<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        Daftar Belanja
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="saleTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ $file->user_id  }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
