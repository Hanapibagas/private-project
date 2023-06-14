<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MytransaksiAdminController extends Controller
{
    public function getIndex()
    {
        $transaksi = Transaction::all();
        return view('components.admin.tranasksi-costumer.index', compact('transaksi'));
    }

    public function getDetails($transaction_code)
    {
        $details = Transaction::where('transaction_code', $transaction_code)->first();
        return view('components.admin.tranasksi-costumer.details-transaksi', compact('details'));
    }

    public function getPemberuan(Request $request, $transaction_code)
    {
        Transaction::where('transaction_code', $transaction_code)->update([
            'status' => $request->status
        ]);

        return redirect()->route('index-transaksi')->with('status', 'Selamat data transaksi berhasil di update');
    }
}