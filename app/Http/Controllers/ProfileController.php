<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $users = Auth::user();
        return view('components.pages.update-profile', compact('users'));
    }
}
