<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Middleware\Guest;
use App\Http\Middleware\ShopAuth;
use Illuminate\Support\Facades\Route;

// Route::group(['prefix' => 'panel', 'namespace' => 'App\Http\Controllers\Admin'], function () {
//     Route::middleware([Guest::class])->group(function () {
//         Route::controller('AuthController')->group(function () {
//             Route::match(['get', 'post'], 'login', 'login')->name('login');
//             Route::get('reset-password', 'reset')->name('reset_password');

//             //     Route::get('/reload-captcha', 'reloadCaptcha');
//         //     Route::post('/check-recaptcha', 'checkRecaptcha');
//         });
//     });

//     // Route::middleware([ShopAuth::class])->group(function () {
//     Route::controller('DashboardController')->group(function () {
//         Route::get('', 'index')->name('dashboard');
//     });
//     Route::controller('BannerController')->group(function () {
//         Route::post('banners/remove-item/{item_id}', 'removeItem')->name('remove_item');
//         Route::resource('banners', BannerController::class);
//     });
//     // });
// });
