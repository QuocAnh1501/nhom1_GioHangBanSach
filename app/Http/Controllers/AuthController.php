<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị view đăng nhập
    public function showFormLogin()
    {
        return view('sign_in'); // Nhớ chỉnh lại tên view đăng nhập của bạn
    }

    // Xử lý Đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Vui lòng nhập email.',
            'email.email'       => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->trang_thai == 0) {
                Auth::logout();
                return back()->withErrors(['email' => 'Tài khoản của bạn đã bị khóa.']);
            }

            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    // Hiển thị view đăng ký
    public function showFormRegister()
    {
        return view('sign_up'); // Nhớ chỉnh lại tên view đăng ký của bạn
    }

    // Xử lý Đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:khachhang,email',
            'password' => 'required|string|min:6',
        ], [
            'fullname.required' => 'Vui lòng nhập họ và tên.',
            'email.required'    => 'Vui lòng nhập email.',
            'email.unique'      => 'Email này đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min'      => 'Mật khẩu phải từ 6 ký tự trở lên.',
        ]);

        $khachHang = KhachHang::create([
            'ho_ten'        => $request->fullname,
            'email'         => $request->email,
            'mat_khau'      => Hash::make($request->password), // Mã hóa mật khẩu
            'so_dien_thoai' => null,
            'dia_chi'       => null,
            'ngay_dang_ky'  => now(),
            'trang_thai'    => 1,
        ]);

        Auth::login($khachHang);

        return redirect()->route('home')->with('success', 'Đăng ký tài khoản thành công!');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Đã đăng xuất.');
    }
}