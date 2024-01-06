<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\BannerController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins'], function () {
    Route::controller('BannerController')->group(function () {
        Route::delete('banners/item/{item_id}', 'removeItem');
        Route::apiResource('banners', BannerController::class);
    });
});
