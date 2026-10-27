<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/gio-hang', function () {
    return view('cart');
})->name('cart');