<?php

use Illuminate\Support\Facades\Route;

Route::get('{any}', function () {
    $path = public_path('themes/'.env('THEME', 'default').'/.output/index.html');

    abort_unless(file_exists($path), 400, 'Make sure to run npm run generate!');

    return file_get_contents($path);
})->where('any', '.*');
