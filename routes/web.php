<?php

use App\Http\Controllers\Admin\DashboradController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog_index');
    Route::get('/cart', [HomeController::class, 'cart'])->name('cart_index');
});

Auth::routes();

Route::prefix('dashboard')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboradController::class, 'index'])->name('dashboard_index');

    //
    Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');
    Route::get('/product/create', [ProductController::class, 'create_product'])->name('create_product');
    Route::post('/product/create/store', [ProductController::class, 'store_product'])->name('store_product');
    Route::get('/product/update/{id}', [ProductController::class, 'edit_product'])->name('edit_product');
    Route::put('/product/update/{id}', [ProductController::class, 'update_product'])->name('update_product');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy_product'])->name('destroy_product');
    Route::get('/product/details/{id}', [ProductController::class, 'details_product'])->name('details_product');
});
