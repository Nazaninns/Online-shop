<?php

use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Alarm\AlarmController;
use App\Http\Controllers\Customer\Cart\CartController;
use App\Http\Controllers\Seller\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware(['auth:seller'])->group(function () {

    //seller
    Route::prefix('seller')->group(function () {
        //product
        Route::apiResource('products', ProductController::class);
    });
});
Route::middleware('auth:customer')->group(function () {
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

Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::apiResource('discounts', DiscountController::class);
    });
});
