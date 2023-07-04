@extends('layouts.owner')

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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar transaksi</h1>
        <a href="{{ route('getExportPDF') }}" target="_blank" class="btn btn-sm btn-danger shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Download PDF
        </a>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">Transaksi kode</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $transaksi as $items )
                        <tr>
                            <th>{{ $items->transaction_code }}</th>
                            <th>{{ $items->user->name }}</th>
                            <th>{{ $items->discount }}%</th>
                            <th>{{ number_format($items->sub_total) }}</th>
                            <th>
                                <span class="badge badge-{{ $items->status == 1 ? 'success' : 'secondary'}}">
                                    {{ $items->status == 1 ? 'Sudah di proses' : 'Sedang di proses'}}
                                </span>
                            </th>
                            <th>
                                {{-- <a href="{{ route('details_tranaksi', $items->transaction_code) }}"
                                    class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a> --}}
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