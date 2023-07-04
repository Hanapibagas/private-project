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

    public function getPembaruan(Request $request, $id)
    {
        $test = Transaction::where('id', $id)->first();

        $test->update([
            'status' => $request->status
        ]);

        return redirect()->route('index-transaksi')->with('status', 'Selamat data transaksi berhasil di update');
    }
}
