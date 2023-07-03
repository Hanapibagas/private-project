<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Mail\TransactionNotification;
use App\Models\Coupon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class MyTransaksiController extends Controller
{
    public function getIndex()
    {
        $user = Auth::user();
        $transaksi = Transaction::where('user_id', $user->id)->count();

        if ($transaksi >= 5 && ($transaksi % 5 == 0 || $transaksi % 10 == 0 || $transaksi % 15 == 0)) {
            Mail::to($user->email)->send(new TransactionNotification($transaksi));

            if ($transaksi >= 15) {
                if ($transaksi % 15 == 0 && !Coupon::where('user_id', $user->id)->exists()) {
                    Coupon::create([
                        'user_id' => $user->id,
                        'coupon_code' => 'Platinum',
                        'discount' => '35'
                    ]);
                }
            } elseif ($transaksi >= 10) {
                if ($transaksi % 10 == 0 && !Coupon::where('user_id', $user->id)->exists()) {
                    Coupon::create([
                        'user_id' => $user->id,
                        'coupon_code' => 'Gold',
                        'discount' => '20'
                    ]);
                }
            } else {
                if ($transaksi % 5 == 0 && !Coupon::where('user_id', $user->id)->exists()) {
                    Coupon::create([
                        'user_id' => $user->id,
                        'coupon_code' => 'Silver',
                        'discount' => '10'
                    ]);
                }
            }
        }

        $transaksi = Transaction::where('user_id', $user->id)->get();

        return view('components.pages.my-transaksi', compact('transaksi'));
    }
}
