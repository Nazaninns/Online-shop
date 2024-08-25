<?php

use App\Http\Controllers\Alarm\AlarmController;
use App\Http\Controllers\Customer\Cart\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum'])->group(function () {

    //seller
    Route::prefix('seller')->group(function () {
        //product
        Route::apiResource('products', ProductController::class);
    });

    //customer
    Route::prefix('customer')->group(function () {
        //cart
        Route::prefix('cart')->controller(CartController::class)->group(function () {
            Route::post('/add', 'addProductToCart');
            Route::post('/remove', 'deleteProductFromCart');
            Route::get('/show', 'showCart');
            Route::post('/pay', 'pay');
        });

        //profile
//        Route::prefix('profile')->controller(ProfileController::class)->group(function () {
//            Route::post('/upload_picture','');
//        });
        //alarm
        Route::prefix('alarm')->controller(AlarmController::class)->group(function () {
            Route::post('/', 'store');
            Route::delete('/', 'destroy');
        });
    });
    //payment
});
