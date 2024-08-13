<?php

use App\Http\Controllers\Seller\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';

Route::middleware(['auth:sanctum'])->group(function (){

    //seller
    //product
        Route::apiResource('products', ProductController::class);
});
