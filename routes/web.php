<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\ChiTietSanPhamController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;

/*
|--------------------------------------------------------------------------
| Trang chủ
|--------------------------------------------------------------------------
*/

Route::get('/', [SanPhamController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Sản phẩm
|--------------------------------------------------------------------------
*/

Route::get('/san-pham', [SanPhamController::class, 'index'])
    ->name('sanpham.index');

Route::get('/san-pham/{id}', [ChiTietSanPhamController::class, 'show'])
    ->name('sanpham.chitiet');

/*
|--------------------------------------------------------------------------
| Giỏ hàng
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| Thanh toán và đặt hàng
|--------------------------------------------------------------------------
|
| Cho phép khách vãng lai đặt hàng mà không cần đăng nhập.
| Không đặt các route này trong middleware auth.
|
*/

Route::get('/thanh-toan', [ClientOrderController::class, 'checkout'])
    ->name('checkout');

Route::post('/thanh-toan', [ClientOrderController::class, 'process'])
    ->name('checkout.process');

/*
|--------------------------------------------------------------------------
| Đăng nhập và đăng ký
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Đăng nhập
    Route::get('/dang-nhap', [AuthController::class, 'showFormLogin'])
        ->name('login');

    Route::post('/dang-nhap', [AuthController::class, 'login'])
        ->name('login.post');

    // Đăng ký
    Route::get('/dang-ky', [AuthController::class, 'showFormRegister'])
        ->name('register');

    Route::post('/dang-ky', [AuthController::class, 'register'])
        ->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Đăng xuất
|--------------------------------------------------------------------------
*/

Route::post('/dang-xuat', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Quản trị
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // Quản lý sản phẩm
        Route::resource('products', ProductController::class);

        // Quản lý đơn hàng
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');
    });