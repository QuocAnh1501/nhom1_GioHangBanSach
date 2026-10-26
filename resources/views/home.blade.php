@extends('layouts.app')

@section('title', 'Trang chủ - BookStore')

@section('content')
<div class="container">
    <section class="welcome-section">
        <h1>Chào mừng đến với BookStore</h1>
        <p>Khám phá những cuốn sách dành cho bạn.</p>
        <form action="#" method="GET" class="search-form" style="align-items: center">
            <input
                type="text"
                name="q"
                placeholder="Tìm kiếm sách, tác giả..."
            >
            <button type="submit">Tìm kiếm</button>
        </form>
    </section>
</div>
@endsection