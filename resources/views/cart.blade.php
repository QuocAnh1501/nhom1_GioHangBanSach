@extends('layouts.app')

@section('title', 'Giỏ hàng - BookStore')

@section('content')
<div class="cart-page">

    {{-- Tiêu đề --}}
    <div class="cart-heading">
        <h1>🛒 Giỏ hàng của bạn</h1>
        <p>Kiểm tra sách bạn đã chọn trước khi thanh toán.</p>
    </div>

    {{-- Thông báo --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (empty($cart))

        {{-- Giỏ hàng trống --}}
        <div class="cart-empty">
            <div class="cart-empty-icon">📚</div>

            <h2>Giỏ hàng đang trống</h2>

            <p>
                Có rất nhiều cuốn sách thú vị đang chờ bạn khám phá.
            </p>

            <a href="{{ route('sanpham.index') }}" class="cart-empty-link">
                Tiếp tục mua sắm
            </a>
        </div>

    @else

        <div class="cart-layout">

            {{-- CỘT TRÁI: DANH SÁCH SẢN PHẨM --}}
            <section class="cart-items-section">

                <div class="cart-card">
                    <div class="cart-table-wrapper">
                        <table class="cart-table">

                            <thead>
                                <tr>
                                    <th colspan="2">SẢN PHẨM</th>
                                    <th>ĐƠN GIÁ</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>THÀNH TIỀN</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($cart as $id => $item)
                                    <tr>
                                        {{-- Ảnh và tên sách --}}
                                        <td colspan="2">
                                            <div class="cart-product">

                                                @if (!empty($item['hinh_anh']))
                                                    <img
                                                        src="{{ asset('storage/' . ltrim($item['hinh_anh'], '/')) }}"
                                                        alt="{{ $item['ten_san_pham'] }}"
                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                                    >

                                                    <div
                                                        style="display:none; width:68px; height:94px; align-items:center; justify-content:center; flex-shrink:0; background:#f5f7f5; border-radius:6px;"
                                                    >
                                                        📚
                                                    </div>
                                                @else
                                                    <div
                                                        style="width:68px; height:94px; display:flex; align-items:center; justify-content:center; flex-shrink:0; background:#f5f7f5; border-radius:6px;"
                                                    >
                                                        📚
                                                    </div>
                                                @endif

                                                <div>
                                                    <div class="cart-product-name">
                                                        {{ $item['ten_san_pham'] }}
                                                    </div>
                                                </div>

                                            </div>
                                        </td>

                                        {{-- Đơn giá --}}
                                        <td>
                                            <span class="cart-product-price">
                                                {{ number_format($item['gia_ban'], 0, ',', '.') }}₫
                                            </span>
                                        </td>

                                        {{-- Số lượng --}}
                                        <td>
                                            <form
                                                action="{{ route('cart.update', ['id' => $id]) }}"
                                                method="POST"
                                                class="cart-quantity-form"
                                            >
                                                @csrf
                                                @method('PUT')

                                                <input
                                                    type="number"
                                                    name="so_luong"
                                                    value="{{ $item['so_luong'] }}"
                                                    min="1"
                                                    max="{{ $item['so_luong_ton'] ?? '' }}"
                                                    required
                                                    class="cart-quantity-input"
                                                    aria-label="Số lượng {{ $item['ten_san_pham'] }}"
                                                >

                                                <button
                                                    type="submit"
                                                    class="cart-update-btn"
                                                    title="Cập nhật số lượng"
                                                    aria-label="Cập nhật số lượng"
                                                >
                                                    ✓
                                                </button>
                                            </form>

                                            @if (isset($item['so_luong_ton']))
                                                <span class="cart-stock">
                                                    Còn {{ $item['so_luong_ton'] }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Thành tiền --}}
                                        <td>
                                            <span class="cart-line-total">
                                                {{ number_format($item['gia_ban'] * $item['so_luong'], 0, ',', '.') }}₫
                                            </span>
                                        </td>

                                        {{-- Xóa --}}
                                        <td>
                                            <form
                                                action="{{ route('cart.remove', ['id' => $id]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Bạn có chắc muốn xóa sách này khỏi giỏ hàng?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="cart-remove-btn"
                                                    title="Xóa sản phẩm"
                                                    aria-label="Xóa {{ $item['ten_san_pham'] }}"
                                                >
                                                    ✕
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

                {{-- Tiếp tục mua sắm --}}
                <a href="{{ route('sanpham.index') }}" class="cart-continue">
                    <span>←</span>
                    Tiếp tục mua sắm
                </a>

            </section>

            {{-- CỘT PHẢI: TÓM TẮT ĐƠN HÀNG --}}
            <aside class="cart-summary">

                <h2>Tóm tắt đơn hàng</h2>

                <div class="cart-summary-row">
                    <span>Số loại sản phẩm</span>
                    <strong>{{ count($cart) }}</strong>
                </div>

                <div class="cart-summary-row">
                    <span>Tổng số lượng</span>
                    <strong>
                        {{ collect($cart)->sum('so_luong') }} cuốn
                    </strong>
                </div>

                <div class="cart-summary-row">
                    <span>Tạm tính</span>
                    <strong>
                        {{ number_format($total, 0, ',', '.') }}₫
                    </strong>
                </div>

                <div class="cart-summary-row">
                    <span>Phí vận chuyển</span>
                    <strong>Tính khi đặt hàng</strong>
                </div>

                <hr class="cart-summary-divider">

                <div class="cart-summary-total">
                    <span>Tổng cộng</span>
                    <strong>
                        {{ number_format($total, 0, ',', '.') }}₫
                    </strong>
                </div>

                <a href="{{ route('checkout') }}" class="cart-checkout-btn">
                    TIẾN HÀNH THANH TOÁN →
                </a>

                {{-- Làm trống giỏ hàng --}}
                <form
                    action="{{ route('cart.clear') }}"
                    method="POST"
                    class="cart-clear-form"
                    onsubmit="return confirm('Bạn có chắc muốn làm trống giỏ hàng?');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="cart-clear-btn">
                        Làm trống giỏ hàng
                    </button>
                </form>

            </aside>

        </div>

    @endif

</div>
@endsection
