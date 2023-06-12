<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Owner\DashboardOwnerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth', 'checkroll:admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'getIndex'])->name('index-dashboard-admin');
});

Route::middleware('auth', 'checkroll:owner')->group(function () {
    Route::get('/dashboard-owner', [DashboardOwnerController::class, 'getIndex'])->name('index-dashboard-owner');
});
