<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\BrandController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins'], function () {
    Route::controller('BrandController')->group(function () {
        Route::apiResource('brands', BrandController::class);

        Route::get('brands/all/list', 'all');
    });
});
