<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\DetailsTransaksi;
use Illuminate\Http\Request;
use PDF;

class TransaksiOwnerController extends Controller
{
    public function getIndex()
    {
        $transaksi = DetailsTransaksi::all();

        return view('components.owner.tranasksi-costumer.index', compact('transaksi'));
    }

    public function getExportPDF(Request $request)
    {
        $dari = $request->input('dari');
        $ke = $request->input('ke');

        $detailsTransaksi = DetailsTransaksi::whereBetween('order_date', [$dari, $ke])->get();

        view()->share('rekap', $detailsTransaksi);

        $pdf = PDF::loadview('components.owner.tranasksi-costumer.rekap-pdf', compact('detailsTransaksi'))->setPaper('a4', 'landscape');

        return $pdf->stream('rekap.pdf');
    }
}
