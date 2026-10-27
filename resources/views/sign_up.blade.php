@extends('layouts.app')

@section('title', 'Đăng ký - BookStore')

@section('content')
<div class="register-page">
    <div class="register-card">

        <h2>Đăng ký tài khoản</h2>

        <form method="POST" action="#">
            @csrf

            <input type="text" name="fullname"
                   placeholder="Họ và tên" required>

            <input type="email" name="email"
                   placeholder="Email" required>

            <input type="password" name="password"
                   placeholder="Mật khẩu" required>

            <button type="submit">Đăng ký</button>
        </form>

        <p>
            Đã có tài khoản?
            <a href="#">Đăng nhập</a>
        </p>

    </div>
</div>
@endsection
    