<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DaftarCostumerController extends Controller
{
    public function index_costumer()
    {
        $user = User::all();
        return view('components.admin.daftar-costumer.index', compact('user'));
    }
}
