<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\Admin\DaftarCostumerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryProductController;
use App\Http\Controllers\Admin\ProductCotroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyTransaksiController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index1');
    Route::get('/prodcut-home', [ProductController::class, 'category'])->name('category1');
    Route::get('/prodcut-home/details/{slug}', [ProductController::class, 'details_products'])->name('details_products');
    Route::get('/transaction/create/{transaction_code?}', [ProductController::class, 'isi_form_pemesanan'])->name('isi_form_pemesanan');
    Route::post('/transaction/post', [ProductController::class, 'add_cart'])->name('add_cart');
    Route::delete('/transaction/delete/{id}', [ProductController::class, 'delete_pesanan'])->name('delete_pesanan');
    Route::put('/transaction/update/pesanan/{id}', [ProductController::class, 'update_pesanan'])->name('update_pesanan');
    Route::post('/sale/getCoupon', [ProductController::class, 'getCoupon'])->name('get_coupon');
    Route::post('/transaction/post-pesanan', [ProductController::class, 'kirim_pesanan_product'])->name('kirim_pesanan_product');

    Route::get('/transaction/success', [ProductController::class, 'success'])->name('success');
    Route::get('/my-transaksi', [MyTransaksiController::class, 'getIndex'])->name('get-index');
});


Auth::routes();

Route::middleware('auth', 'checkroll:admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'dashboard_index'])->name('dashboard_index');
    //
    Route::get('/banner', [BannerController::class, 'index_banner'])->name('index_banner');
    Route::get('/banner/create', [BannerController::class, 'create_banner'])->name('create_banner');
    Route::get('/banner/edit/{id}', [BannerController::class, 'edit_banner'])->name('edit_banner');
    Route::put('/banner/update/{id}', [BannerController::class, 'update_banner'])->name('update_banner');
    Route::post('/banner/post', [BannerController::class, 'store_banner'])->name('store_banner');
    Route::delete('/banner/delete/{id}', [BannerController::class, 'destroy_banner'])->name('destroy_banner');
    //
    Route::get('/coupon', [CuponController::class, 'index_cupon'])->name('index_cupon');
    Route::get('/coupon/create', [CuponController::class, 'create_cupon'])->name('create_cupon');
    Route::post('/coupon/post', [CuponController::class, 'store_cupon'])->name('store_cupon');
    Route::get('/coupon/edit/{id}', [CuponController::class, 'edit_cupon'])->name('edit_cupon');
    Route::put('/coupon/update/{id}', [CuponController::class, 'update_cupon'])->name('update_cupon');
    Route::delete('/coupon/delete/{id}', [CuponController::class, 'destroy_cupon'])->name('destroy_cupon');
    //
    Route::get('/daftar-costumer', [DaftarCostumerController::class, 'index_costumer'])->name('index_costumer');
    //
    Route::get('/product', [ProductCotroller::class, 'index_product'])->name('index_product');
    Route::get('/product/create', [ProductCotroller::class, 'create_product'])->name('create_product');
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
