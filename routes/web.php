<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\Admin\DaftarCostumerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCotroller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
});

Auth::routes();

Route::middleware('auth', 'checkroll:admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'dashboard_index'])->name('dashboard_index');
    //
    Route::get('/coupon', [CuponController::class, 'index_cupon'])->name('index_cupon');
    Route::get('/coupon/create', [CuponController::class, 'create_cupon'])->name('create_cupon');
    //
    Route::get('/daftar-costumer', [DaftarCostumerController::class, 'index_costumer'])->name('index_costumer');
    //
    Route::get('/product', [ProductCotroller::class, 'index_product'])->name('index_product');
    Route::get('.product/create', [ProductCotroller::class, 'create_product'])->name('create_product');
    Route::get('/product/edit/{id}', [ProductCotroller::class, 'edit_product'])->name('edit_product');
    Route::put('/product/update/{id}', [ProductCotroller::class, 'update_product'])->name('update_product');
    Route::post('/product/post', [ProductCotroller::class, 'store_product'])->name('store_product');
    Route::delete('/product/delete/{id}', [ProductCotroller::class, 'destroy_product'])->name('destroy_product');
    //
    Route::get('/category', [CategoryController::class, 'index_category'])->name('index_category');
    Route::get('/category/create', [CategoryController::class, 'create_cataegory'])->name('create_cataegory');
    Route::get('/category/update/{id}', [CategoryController::class, 'edit_category'])->name('edit_category');
    Route::put('/category/post/{id}', [CategoryController::class, 'update_category'])->name('update_category');
    Route::post('/category/post', [CategoryController::class, 'store_category'])->name('store_category');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy_category'])->name('destroy_category');
});
