@extends('layouts.admin')

@section('title')
Cupon
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah cupon</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('store_category') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
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
                    <div class="col">
                        <label for="">Status</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                            </div>
                            <select class="form-control" name="status">
                                <option value="0" {{ old('status')==0 ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="1" {{ old('status')==0 ? 'selected' : '' }}}>Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col">
                        <label>Kode Kupon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-key"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control coupon"
                                onkeyup="this.value = this.value.toUpperCase();"
                                onkeypress="return event.charCode != 32" name="coupon_code"
                                value="{{ old('coupon_code') }}">
                        </div>
                    </div>
                    <div class="col">
                        <label for="">Discount</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-percentage"></i>
                                </div>
                            </div>
                            <input type="number" class="form-control" name="discount"
                                onKeyPress="if(this.value >= 100) return false;" value="{{ old('discount') }}" />
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col">
                        <label>Expired</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-times"></i>
                                </div>
                            </div>
                            <input type="date" name="expired" class="form-control" value="{{ old('expired') }}" />
                        </div>
                    </div>
                    <div class="col">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="description" rows="10">{{ old('description') }}</textarea>
                    </div>
                </div>

                <button type="submit" style="margin-top: 20px" class="btn btn-primary btn-block">
                    Tambah kategori
                </button>
            </form>
        </div>
    </div>
</div>
@endsection