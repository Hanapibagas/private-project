<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Owner\DashboardOwnerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home_index');
});

Auth::routes();

Route::middleware('auth', 'checkroll:admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'getIndex'])->name('index-dashboard-admin');
});

Route::middleware('auth', 'checkroll:owner')->group(function () {
    Route::get('/dashboard-owner', [DashboardOwnerController::class, 'getIndex'])->name('index-dashboard-owner');
});
