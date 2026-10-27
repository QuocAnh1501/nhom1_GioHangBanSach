<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showFormRegister()
    {
        return view('sign_up');
    }

    // Hiển thị form đăng nhập
    public function showFormLogin()
    {
        return view('sign_in');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $validated = $request->validate([
            'hoten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:khachhang,email',
            'mat_khau' => 'required|string|min:6',
        ]);

        // Mặc định tài khoản mới luôn là customer.
        // Không lấy role từ dữ liệu do người dùng gửi lên.
        KhachHang::create([
            'ho_ten' => $validated['hoten'],
            'email' => $validated['email'],
            'so_dien_thoai' => $request->input('so_dien_thoai'),
            'dia_chi' => $request->input('dia_chi'),
            'mat_khau' => Hash::make($validated['mat_khau']),
            'ngay_dang_ky' => now(),
            'trang_thai' => 1,
            'role' => 'customer',
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Đăng ký tài khoản thành công!');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'mat_khau' => 'required',
        ]);

        $remember = $request->boolean('remember');

        // Dùng tên cột password của Laravel để xác thực
        // với mật khẩu lưu trong cột mat_khau.
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['mat_khau'],
            'trang_thai' => 1,
        ], $remember)) {
            $request->session()->regenerate();

            // Admin vào trang quản trị, khách hàng vào trang chủ.
            if (Auth::user()->role === 'admin') {
                return redirect()
                    ->route('admin.orders.index')
                    ->with('success', 'Đăng nhập quản trị thành công!');
            }

            return redirect()
                ->intended('/')
                ->with('success', 'Đăng nhập thành công!');
        }

        return back()
            ->withErrors([
                'email' => 'Email hoặc mật khẩu không chính xác, hoặc tài khoản đã bị khóa.',
            ])
            ->onlyInput('email');
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Đã đăng xuất.');
    }
}