@extends('layouts.app')

@section('title', 'Trang chủ - BookStore')

@section('content')

<div class="container">

```
{{-- Phần chào mừng --}}
<section class="welcome-section">
    <h1>Chào mừng đến với BookStore</h1>
    <p>Khám phá những cuốn sách dành cho bạn.</p>

    <form action="{{ url('/') }}" method="GET" class="search-form" style="align-items: center">
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Tìm kiếm sách, tác giả..."
        >
        <button type="submit">Tìm kiếm</button>
    </form>
</section>

{{-- Danh sách sách --}}
<section class="products-section">
    <h2>Danh sách sách</h2>

    @if ($sanPhams->isEmpty())
        <p>Hiện chưa có sách nào.</p>
    @else
        <div class="product-list">
            @foreach ($sanPhams as $sanPham)
                <article class="product-item">

                    @if ($sanPham->hinh_anh)
                        <img
                            src="{{ asset('storage/' . $sanPham->hinh_anh) }}"
                            alt="{{ $sanPham->ten_san_pham }}"
                            class="product-image"
                        >
                    @endif

                    <h3>{{ $sanPham->ten_san_pham }}</h3>

                    <p>
                        Tác giả:
                        {{ $sanPham->tac_gia ?: 'Chưa cập nhật' }}
                    </p>

                    <p>
                        Nhà xuất bản:
                        {{ $sanPham->nha_xuat_ban ?: 'Chưa cập nhật' }}
                    </p>

                    <p class="product-price">
                        {{ number_format($sanPham->gia_ban, 0, ',', '.') }} VNĐ
                    </p>

                    @if ($sanPham->so_luong_ton > 0)
                        <p>Còn hàng</p>
                    @else
                        <p>Hết hàng</p>
                    @endif

                </article>
            @endforeach
        </div>
    @endif
</section>
```

</div>
@endsection
