@extends('layouts.app')

@section('title', 'Đăng nhập - BookStore')

@section('content')
<div class="auth-container" style="display: flex; justify-content: center; align-items: center; min-height: 60vh; padding: 40px 0;">
    <div class="auth-card" style="width: 100%; max-width: 440px; background: #ffffff; padding: 40px 35px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
        
        <h2 class="auth-title" style="text-align: center; margin-bottom: 24px;">Đăng nhập</h2>

        <!-- Hiển thị thông báo lỗi -->
        @if ($errors->any())
            <div style="color: #dc3545; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                @foreach ($errors->all() as $error)
                    <p style="margin: 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group" style="margin-bottom: 16px;">
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="Email" 
                    required 
                    class="auth-input"
                    style="width: 100%; height: 48px; padding: 0 16px; font-size: 15px; border: 1px solid #dcdfe6; border-radius: 8px; box-sizing: border-box;"
                >
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Mật khẩu" 
                    required 
                    class="auth-input"
                    style="width: 100%; height: 48px; padding: 0 16px; font-size: 15px; border: 1px solid #dcdfe6; border-radius: 8px; box-sizing: border-box;"
                >
            </div>

            <button type="submit" class="auth-btn" style="width: 100%; height: 48px; background-color: #1b6a43; color: #fff; font-size: 16px; font-weight: 600; border: none; border-radius: 8px; cursor: pointer;">
                Đăng nhập
            </button>

            <div class="auth-footer" style="text-align: center; margin-top: 20px; font-size: 14px;">
                Chưa có tài khoản? <a href="{{ route('register') }}" class="auth-link" style="color: #222; font-weight: 600; text-decoration: none;">Đăng ký ngay</a>
            </div>
        </form>
    </div>
</div>
@endsection