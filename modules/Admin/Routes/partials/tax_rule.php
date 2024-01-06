<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\TaxRuleController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins'], function () {
    Route::controller('TaxRuleController')->group(function () {
        Route::apiResource('tax-rules', TaxRuleController::class);
        Route::get('tax-rules/all/list', 'all');
    });
});
