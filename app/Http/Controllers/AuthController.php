<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showFormRegister()
    {
        return view('sign_up'); // Đảm bảo file tên sign_up.blade.php
    }

    public function showFormLogin()
    {
        return view('sign_in'); // Đảm bảo file tên sign_in.blade.php
    }

    // 1. XỬ LÝ ĐĂNG KÝ
    public function register(Request $request)
    {
        $request->validate([
            'hoten'    => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:khachhang,email',
            'mat_khau' => 'required|string|min:6',
        ]);

        // Tạo khách hàng mới vào CSDL
        KhachHang::create([
            'ho_ten'        => $request->hoten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai ?? null,
            'dia_chi'       => $request->dia_chi ?? null,
            'mat_khau'      => Hash::make($request->mat_khau), // Nên để tên cột CSDL là password
            'ngay_dang_ky'  => now(),
            'trang_thai'    => 1,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công!');
    }

    // 2. XỬ LÝ ĐĂNG NHẬP
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'mat_khau' => 'required',
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['mat_khau']])) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ]);
    }

    // 3. ĐĂNG XUẤT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Đã đăng xuất.');
    }
}