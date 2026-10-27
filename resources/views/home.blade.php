@extends('layouts.app')

@section('title', 'Trang chủ - BookStore')

@section('content')

<div class="container">

```
{{-- Phần chào mừng và tìm kiếm --}}
<section class="welcome-section">
    <h1>Khám phá thế giới sách cùng BookStore</h1>
    <p>Tri thức trong tầm tay, cảm hứng trên từng trang sách.</p>

    <form action="{{ url('/') }}" method="GET" class="search-form">
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Tìm tên sách hoặc tác giả..."
        >
        <button type="submit">Tìm kiếm</button>
    </form>
</section>

{{-- Danh sách sản phẩm --}}
<section class="products-section">
    <div class="section-heading">
        <div>
            <h2>Sách dành cho bạn</h2>
            <p>Khám phá những cuốn sách nổi bật tại cửa hàng.</p>
        </div>

        <span class="product-count">
            {{ $sanPhams->count() }} sản phẩm
        </span>
    </div>

    @if ($sanPhams->isEmpty())
        <div class="empty-products">
            <h3>Chưa tìm thấy sách phù hợp</h3>
            <p>Thử tìm kiếm bằng tên sách hoặc tác giả khác nhé!</p>
            <a href="{{ url('/') }}" class="reset-search">
                Xem tất cả sách
            </a>
        </div>
    @else
        <div class="product-grid">
            @foreach ($sanPhams as $sanPham)
                <article class="product-card">

                    <div class="product-image-wrapper">
                        @if ($sanPham->hinh_anh)
                            <img
                                src="{{ asset('storage/' . $sanPham->hinh_anh) }}"
                                alt="{{ $sanPham->ten_san_pham }}"
                                class="product-image"
                                loading="lazy"
                            >
                        @else
                            <div class="no-image">
                                <span>📚</span>
                                <p>Chưa có ảnh bìa</p>
                            </div>
                        @endif

                        @if ($sanPham->so_luong_ton > 0)
                            <span class="stock-badge in-stock">
                                Còn hàng
                            </span>
                        @else
                            <span class="stock-badge out-of-stock">
                                Hết hàng
                            </span>
                        @endif
                    </div>

                    <div class="product-info">
                        <h3 class="product-name">
                            {{ $sanPham->ten_san_pham }}
                        </h3>

                        <p class="product-author">
                            {{ $sanPham->tac_gia ?: 'Chưa cập nhật tác giả' }}
                        </p>

                        <p class="product-publisher">
                            {{ $sanPham->nha_xuat_ban ?: 'Chưa cập nhật NXB' }}
                        </p>

                        <div class="product-bottom">
                            <span class="product-price">
                                {{ number_format($sanPham->gia_ban, 0, ',', '.') }}₫
                            </span>

                            <span class="stock-quantity">
                                Còn {{ $sanPham->so_luong_ton }}
                            </span>
                        </div>
                    </div>

                </article>
            @endforeach
        </div>
    @endif
</section>
```

</div>
@endsection
