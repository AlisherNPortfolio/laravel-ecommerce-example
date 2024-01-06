<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::controller('ShopController')->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::get('404', function () {
    return view('404');
})->name('not_found');
