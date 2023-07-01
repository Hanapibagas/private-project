<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyTransaksiController extends Controller
{
    public function getIndex()
    {
        $transaksi = Transaction::where('user_id', Auth::user()->id)->get();
        return view('components.pages.my-transaksi', compact('transaksi'));
    }
}
