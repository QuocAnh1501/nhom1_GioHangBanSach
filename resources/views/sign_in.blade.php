 @extends('layouts.app')

@section('title', 'Đăng nhập - BookStore')

@section('content')
<div class="sign_in-page">
    <div class="sign_in-card">

        <h2>Đăng nhập</h2>

        <form method="POST" action="#">
            @csrf

            <input
                type="email"
                name="email"
                placeholder="Email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Mật khẩu"
                required
            >

            <button type="submit">Đăng nhập</button>
        </form>

        <p>
            Chưa có tài khoản?
            <a href="#">Đăng ký ngay</a>
        </p>

    </div>
</div>
@endsection