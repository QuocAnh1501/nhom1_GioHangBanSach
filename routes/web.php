<?php
use App\Http\Controllers\SanPhamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChiTietSanPhamController;

Route::get('/', [SanPhamController::class, 'index'])
    ->name('home');

// Sản phẩm
Route::get('/san-pham', [SanPhamController::class, 'index'])
    ->name('sanpham.index');

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

// Chi tiết sản phẩm
Route::get('/san-pham/{id}', [ChiTietSanPhamController::class, 'show'])
    ->name('sanpham.chitiet');