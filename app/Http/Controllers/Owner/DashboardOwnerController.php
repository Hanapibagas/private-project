<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardOwnerController extends Controller
{
    public function getIndex()
    {
        return view('components.owner.dashboard');
    }
}
