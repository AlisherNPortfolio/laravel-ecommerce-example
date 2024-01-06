<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\PaymentController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins'], function () {
    Route::controller('PaymentController')->group(function () {
        Route::apiResource('payment-types', PaymentController::class);
        Route::get('payment-types/all/list', 'all');
    });
});
