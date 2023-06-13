<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
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
        $users = User::all();
        return view('components.admin.cupon.create', compact('users'));
    }

    public function store_cupon(Request $request)
    {
        $data = $request->all();
        $data['coupon_code'] = strtoupper(str_replace(' ', '', $data['coupon_code']));

        Coupon::create($data);

        return redirect()->route('index_cupon')->with('status', 'Selamat data product berhasil ditambahkan');
    }

    public function edit_cupon(Request $request, $id)
    {
        $item = Coupon::findOrFail($id);
        return view('components.admin.cupon.update', compact('item'));
    }

    public function update_cupon(Request $request, $id)
    {
        $data = $request->all();

        Coupon::findOrFail($id)->update($data);
        return redirect()->route('index_cupon')->with('status', 'Selamat data product berhasil ditambahkan');
    }

    public function destroy_cupon($id)
    {
        Coupon::findOrFail($id)->delete();
        return response()->json(['status' => 'Selamat data category berhasil dihapus']);
    }
}
