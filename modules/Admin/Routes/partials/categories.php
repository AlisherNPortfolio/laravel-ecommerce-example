<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\CategoryController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins'], function () {
    Route::controller('CategoryController')->group(function () {
        Route::get('categories/tree-view', 'getTree');
        Route::apiResource('categories', CategoryController::class);
    });
});
