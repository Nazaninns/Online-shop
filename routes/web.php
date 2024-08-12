<?php

use App\Http\Controllers\Seller\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('seller/')->middleware('auth:seller')->group(function () {
    Route::get('dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    Route::resource('products',ProductController::class);
});

