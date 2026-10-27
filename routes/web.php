<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('home');
});

// Giỏ hàng
Route::get('/gio-hang', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/gio-hang/them/{id}', [CartController::class, 'add'])
    ->name('cart.add');

Route::put('/gio-hang/cap-nhat/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/gio-hang/xoa/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::delete('/gio-hang/lam-trong', [CartController::class, 'clear'])
    ->name('cart.clear');