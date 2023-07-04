@extends('layouts.admin')

@section('title')
Transaksi
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.css" />
@endpush

@section('content')
@if (session('status'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text : "{{ session('status') }}",
    });
</script>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama akun pengguna</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $transaksi as $key => $items )
                        <tr>
                            <th>{{ $key+1}}</th>
                            <th>{{ $items->user->name }}</th>
                            <th>{{ $items->discount }}%</th>
                            <th>{{ number_format($items->sub_total) }}</th>
                            <th>
                                <span class="badge badge-{{ $items->status == 1 ? 'success' : 'secondary'}}">
                                    {{ $items->status == 1 ? 'Sudah di proses' : 'Sedang di proses'}}
                                </span>
                            </th>
                            <th>
                                <a data-toggle="modal" data-target="#editItem-{{ $items->id }}" class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($transaksi as $item)
<div class="modal fade" tabindex="-1" role="dialog" id="editItem-{{ $item->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('update_transaksi', $item->id  ) }}" method="POST">
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
                        <label>Bukti Bayar :</label>
                        <img style="width: 100%;" src="{{ Storage::url($item->foto) }}" alt="">
                    </div>
                    <div class="form-group">
                        <label>Ubah status pemesanan :</label>
                        <select class="form-control" name="status">
                            <option value="1">Terima pesanan</option>
                            <option value="0">Tolak pesanan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-success">Kirim pembaruan data</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btndelete').click(function (e) {
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_id').val();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat memulihkan data ini lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            'id': deleteid,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: 'product/delete/' + deleteid,
                            data: data,
                            success: function (response) {
                                swal(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        });

    });

</script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endpush