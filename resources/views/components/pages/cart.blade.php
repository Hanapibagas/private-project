@extends('layouts.app')

@section('title')
Store Cart Page
@endsection

@section('content')
@if (session('status'))
<script>
    Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: "{{ session('status') }}",
            });
</script>
@endif

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
                                Cart
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="store-cart">
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
                                    <th scope="col">Gambar Product</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $data as $key => $item )
                                <tr>
                                    <th>{{ $key+ 1 }}</th>
                                    <th>
                                        <img src="{{ Storage::url($item->photo) }}" alt="Foto Produk"
                                            class="img-fluid rounded mt-1 mb-1" height="10px" width="80px" />
                                    </th>
                                    <th>{{ $item->product->name }}</th>
                                    <th>Rp. {{ number_format($item->product_price, 0,',',',') }}</th>
                                    <th>{{ $item->quantity }}</th>
                                    <th>Rp. {{ number_format($item->total_price, 0,',',',') }}</th>
                                    <th class="text-right">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-success btn-icon icon-left" data-toggle="modal"
                                                data-target="#editItem-{{ $item->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('getDeleteCart', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="btn btn-danger btn-icon icon-left btn-delete">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body d-flex">
                    <div class="col-md-4 col-lg-6"">
                        <div class=" form-group">
                        <label for="zip_code">Total</label>
                        <span id="total" class="product-title text-success">Rp.
                        </span>
                    </div>
                </div>

                <div class="col-md-4 col-lg-6 text-right" style="margin-top: 0;">
                    <form action="{{ route('getCheckOut') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            Checkout Now
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                    <hr />
                </div>
                <div class="col-12">
                    <h2 class="mb-4">Shipping Details</h2>
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_one">Address 1</label>
                            <input type="text" class="form-control" id="address_one" name="address_one"
                                value="Setra Duta Cemara" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_two">Address 2</label>
                            <input type="text" class="form-control" id="address_two" name="address_two"
                                value="Blok B2 No. 34" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinces_id">Province</label>
                            <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id"
                                v-if="provinces">
                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                            </select>
                            <select v-else class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="regencies_id">City</label>
                            <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id"
                                v-if="regencies">
                                <option v-for="regency in regencies" :value="regency.id">@{{regency.name }}</option>
                            </select>
                            <select v-else class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Postal Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="40512" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="Indonesia" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Mobile</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="+628 2020 11111" />
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-1">Payment Informations</h2>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-4 col-md-2">
                        <div class="product-title">$0</div>
                        <div class="product-subtitle">Country Tax</div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="product-title">$0</div>
                        <div class="product-subtitle">Product Insurance</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title">$0</div>
                        <div class="product-subtitle">Ship to Jakarta</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title text-success">${{ number_format($totalPrice ?? 0) }}</div>
                        <div class="product-subtitle">Total</div>
                    </div>
                    <div class="col-8 col-md-3">
                        <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                            Checkout Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
        {{-- <div class="card" style="margin-top: 20px;">
            <div class="col-12">
                <h2 class="mb-4">Alamat Penerima</h2>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <form action="{{ route('getKupon') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>voucher tersedia <code>(Jika ada)</code></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="diskon" name="diskon"
                                    value="{{ old('diskon') }}" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Gunakan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Nama Lengkap</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">No.tlpn</label>
                            <input type="number" class="form-control" name="zip_code" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Metode Pembayaran</label>
                            <select name="" class="form-control">
                                <option value="">-- Silahkan Pilih -- </option>
                                <option value="COD">COD</option>
                                <option value="JNT">JNT</option>
                                <option value="JNE">JNE</option>
                                <option value="TIKI">TIKI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Bukti Pembayaran</label>
                            <input type="file" class="form-control-file" name="zip_code" value="40512" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Alamat</label>
                            <textarea class="form-control" name="" id="" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-1">Payment Informations</h2>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-4 col-md-2">
                        <div class="product-title">%0</div>
                        <div class="product-subtitle">Diskon</div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="product-title">Rp.0</div>
                        <div class="product-subtitle">Potongan Diskon</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div id="total" class="product-title text-success">Rp.
                        </div>
                        <div class="product-subtitle">Total</div>
                    </div>
                    <div class="col-8 col-md-3">
                        <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                            Checkout Now
                        </button>
                    </div>
                </div>
            </form>
        </div> --}}
</div>
</section>
</div>

@foreach ($data as $item)
<div class="modal fade" tabindex="-1" role="dialog" id="editItem-{{ $item->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('getUpdateCart', $item->id  ) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ $item->product->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" class="form-control" value="{{ $item->product->product_code }}" readonly />
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}"
                            required />
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('js')
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        var couponSelect = document.querySelector('select[name="coupon_code"]');
        var discountPercentage = 0; // Persentase diskon
        var discountAmount = 0; // Potongan harga

        couponSelect.addEventListener('change', function () {
            var selectedOption = couponSelect.options[couponSelect.selectedIndex];
            discountPercentage = parseFloat(selectedOption.dataset.discount);
            discountAmount = parseFloat(selectedOption.dataset.amount);

            calculateTotal();
        });

        function calculateTotal() {
            var totalElement = document.getElementById('total');
            var subtotalElement = document.querySelector('.product-title.text-success');
            var subtotal = 0;

            var rows = document.getElementById('saleTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var price = parseFloat(row.cells[3].textContent.trim().replace('Rp. ', '').replace(',', ''));
                var quantity = parseInt(row.cells[4].textContent.trim());
                var rowTotal = price * quantity;

                subtotal += rowTotal;
            }

            var discount = subtotal * (discountPercentage / 100);
            var total = subtotal - discount - discountAmount;

            subtotalElement.textContent = 'Rp. ' + subtotal.toLocaleString('id-ID');
            totalElement.textContent = 'Rp. ' + total.toLocaleString('id-ID');
        }
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var table = document.getElementById('saleTable');
        var totalElement = document.getElementById('total');

        function updateTotal() {
            var total = 0;
            var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var price = row.cells[3].textContent.trim().replace('Rp. ', '').replace(',', '');
                var quantity = row.cells[4].textContent.trim();
                var rowTotal = parseFloat(price) * parseInt(quantity);

                total += rowTotal;
            }

            totalElement.textContent = 'Rp.' + total.toLocaleString('id-ID');
        }

        updateTotal();

        table.addEventListener('input', function (event) {
            var element = event.target;

            if (element.tagName === 'INPUT' && element.name === 'quantity') {
                updateTotal();
            }
        });
    });
</script>
@endpush