<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard_index()
    {
        $producy = Product::count();
        $user = User::count();
        $diproses = Transaction::where('status', '0')->count();
        $diterima = Transaction::where('status', '1')->count();
        return view('components.admin.dashboard', compact('producy', 'user', 'diproses', 'diterima'));
    }
}
