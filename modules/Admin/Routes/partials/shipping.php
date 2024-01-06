<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\ShippingController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins'], function () {
    Route::controller('ShippingController')->group(function () {
        Route::apiResource('shippings', ShippingController::class);
        Route::get('shippings/all/list', 'all');
    });
});
