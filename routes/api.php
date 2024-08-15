<?php

use App\Http\Controllers\Customer\Cart\CartController;
use App\Http\Controllers\Seller\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum'])->group(function () {

    //seller
    //product
    Route::apiResource('products', ProductController::class);


    //customer

    //cart
    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::post('/add', 'addProductToCart');
        Route::post('/remove', 'removeProductFromCart');
        Route::post('/payment','pay');
    });
    //payment
});
