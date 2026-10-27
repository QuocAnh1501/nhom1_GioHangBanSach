<?php
use App\Http\Controllers\SanPhamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChiTietSanPhamController;

// Import thêm 2 Admin Controller đúng với cấu trúc thư mục của bạn
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;


use App\Http\Controllers\AuthController;


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
    /*
|--------------------------------------------------------------------------
| Admin Routes (Giao diện quản trị)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Quản lý sản phẩm (CRUD: Danh sách, Thêm, Sửa, Xóa)
    Route::resource('products', ProductController::class);

    // Quản lý đơn hàng
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

   /*
|--------------------------------------------------------------------------
| Đăng nhập và đăng ký
|--------------------------------------------------------------------------
*/

Route::get('/dang-nhap', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login.post');

// Đăng ký
Route::get('/dang-ky', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('/dang-ky', [AuthController::class, 'register'])->name('register.post');

// Đăng xuất
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');