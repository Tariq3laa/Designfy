<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin/product'
],
    function () {
        Route::apiResource('attributes', AttributeController::class);
        Route::apiResource('products', ProductController::class);
    }
);
