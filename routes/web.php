<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home',[HomeController::class,'index'] );
Auth::routes();

//seller
Route::prefix('seller/')->middleware('auth:seller')->group(function () {
    Route::get('dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    Route::resource('products',ProductController::class);
    Route::post('logout', [SellerController::class, 'logout'])->name('seller.logout');
});
//customer
Route::prefix('customer/')->middleware('auth:customer')->group(function () {
    Route::get('dashboard', [customerController::class, 'dashboard'])->name('customer.dashboard');
    Route::resource('products',ProductController::class);
    Route::post('logout', [CustomerController::class, 'logout'])->name('customer.logout');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
});
//admin
Route::prefix('admin/')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('products',ProductController::class);
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
});
