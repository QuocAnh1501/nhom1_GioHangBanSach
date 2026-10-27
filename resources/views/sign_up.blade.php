@extends('layouts.app')

@section('title', 'Đăng ký tài khoản | BookStore')

@section('content')
<div class="register-page">
    <div class="register-card">

        <div class="register-heading">
            <div class="register-icon">B</div>
            <h1>Tạo tài khoản</h1>
            <p>Tham gia BookStore để khám phá thế giới sách</p>
        </div>

        {{-- Thông báo lỗi --}}
        @if ($errors->any())
            <div class="register-alert register-alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="register-field">
                <label for="hoten">Họ và tên</label>
                <input
                    type="text"
                    name="hoten"
                    id="hoten"
                    value="{{ old('hoten') }}"
                    placeholder="Nhập họ và tên"
                    required
                >
            </div>

            <div class="register-field">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="example@email.com"
                    required
                >
            </div>

            <div class="register-field">
                <label for="mat_khau">Mật khẩu</label>
                <input
                    type="password"
                    name="mat_khau"
                    id="mat_khau"
                    placeholder="Nhập mật khẩu"
                    required
                >
            </div>

            <button type="submit" class="register-submit">
                Đăng ký tài khoản
            </button>
        </form>

        <p class="register-login">
            Đã có tài khoản?
            <a href="{{ route('login') }}">Đăng nhập ngay</a>
        </p>

    </div>
</div>
@endsection