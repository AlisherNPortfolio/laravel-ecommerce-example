<?php

use Illuminate\Support\Facades\Route;
use Theme\Default\Http\Controllers\CartController;
use Theme\Default\Http\Controllers\CommonController;
use Theme\Default\Http\Controllers\HomeController;
use Theme\Default\Http\Controllers\ProductController;

Route::controller(HomeController::class)->group(function () {
    Route::get('home-products', 'index');
});

Route::controller(CommonController::class)->group(function () {
    Route::get('categories', 'getCategories');
    Route::get('brands', 'getBrands');
});

Route::controller(ProductController::class)->group(function () {

});

Route::controller(CartController::class)->group(function () {
    Route::apiResource('carts', CartController::class);
});
