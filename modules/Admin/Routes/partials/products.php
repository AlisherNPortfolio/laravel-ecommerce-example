<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AttributeController;
use Modules\Admin\Http\Controllers\ProductController;
use Modules\Common\Http\Controllers\FileController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins'], function () {
    Route::controller('ProductController')->group(function () {
        Route::apiResource('products', ProductController::class);
        Route::post('products/skus', 'storeVariants');
    });

    Route::controller('AttributeController')->group(function () {
        Route::apiResource('attributes', AttributeController::class);
        Route::get('attributes/all/list', 'getAll');
    });
});
