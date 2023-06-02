<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    public function index_cupon()
    {
        $cupon = Coupon::all();
        return view('components.admin.cupon.index', compact('cupon'));
    }

    public function create_cupon()
    {
        return view('components.admin.cupon.create');
    }

    public function store_cupon(Request $request)
    {
        $data = $request->all();
        $data['coupon_code'] = strtoupper(str_replace(' ', '', $data['coupon_code']));

        Coupon::create($data);

        return redirect()->route('index_cupon')->with('status', 'Selamat data product berhasil ditambahkan');
    }
}
