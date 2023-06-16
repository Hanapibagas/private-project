<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class TransaksiOwnerController extends Controller
{
    public function getIndex()
    {
        $transaksi = Transaction::all();
        return view('components.owner.tranasksi-costumer.index', compact('transaksi'));
    }

    public function getExportPDF()
    {
        $data = Transaction::all();

        view()->share('rekap', $data);

        $pdf = PDF::loadview('components.owner.tranasksi-costumer.rekap-pdf', compact('data'))->setPaper('a4', 'landscape');

        return $pdf->stream('rekap.pdf');
    }
}
