<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth', 'checkroll:admin')->group(function () {
    Route::get('dashboard-admin', [DashboardController::class, 'dashboard_index'])->name('dashboard_index');
    //
    Route::get('category', [CategoryController::class, 'index_category'])->name('index_category');
});
