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

    // 1. XỬ LÝ ĐĂNG KÝ
    public function register(Request $request)
    {
        $request->validate([
            'hoten'    => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:khachhang,email',
            'mat_khau' => 'required|string|min:6',
        ]);

        // Tạo tài khoản khách hàng mới
        KhachHang::create([
            'ho_ten'        => $request->hoten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai ?? null,
            'dia_chi'       => $request->dia_chi ?? null,
            'mat_khau'      => Hash::make($request->mat_khau),
            'ngay_dang_ky'  => now(),
            'trang_thai'    => 1,
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Đăng ký tài khoản thành công!');
    }

    // 2. XỬ LÝ ĐĂNG NHẬP
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'mat_khau' => 'required',
        ]);

        // Chỉ cho phép tài khoản đang hoạt động đăng nhập
        if (Auth::attempt([
            'email'      => $credentials['email'],
            'password'   => $credentials['mat_khau'],
            'trang_thai' => 1,
        ])) {
            // Tạo lại session để tăng cường bảo mật
            $request->session()->regenerate();

            return redirect()
                ->intended('/')
                ->with('success', 'Đăng nhập thành công!');
        }

        return back()
            ->withErrors([
                'email' => 'Email hoặc mật khẩu không chính xác.',
            ])
            ->onlyInput('email');
    }

    // 3. XỬ LÝ ĐĂNG XUẤT
    public function logout(Request $request)
    {
        Auth::logout();

        // Hủy session hiện tại
        $request->session()->invalidate();

        // Tạo lại CSRF token
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Đã đăng xuất.');
    }
}