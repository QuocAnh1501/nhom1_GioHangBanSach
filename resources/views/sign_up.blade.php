@extends('layouts.app')

@section('title', 'Đăng ký - BookStore')

@section('content')
<div class="register-page">
    <div class="register-card">

        <h2>Đăng ký tài khoản</h2>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <input type="text" name="hoten"
                   placeholder="Họ và tên" required>

            <input type="email" name="email"
                   placeholder="Email" required>

            <input type="password" name="mat_khau"
                   placeholder="Mật khẩu" required>

            <button type="submit">Đăng ký</button>
        </form>

        <p>
            Đã có tài khoản?
            <a href="{{ route('login') }}">Đăng nhập</a>
        </p>

    </div>
</div>
@endsection
    