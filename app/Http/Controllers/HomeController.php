<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('landing.pages.index');
    }

    public function catalog()
    {
        return view('landing.pages.catalog');
    }

    public function cart()
    {
        return view('landing.pages.keranjang');
    }
}
