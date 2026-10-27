@extends('layouts.app')

@section('title', 'Thanh toán - BookStore')

@section('content')
<div class="container checkout-page">
    <div style="max-width: 1100px; margin: 0 auto;">

        {{-- Tiêu đề --}}
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: #114b3e;">
                💳 Thanh toán đơn hàng
            </h2>
            <p class="text-muted">
                Kiểm tra thông tin giao hàng và xác nhận đơn hàng của bạn.
            </p>
        </div>

        {{-- Thông báo lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Vui lòng kiểm tra lại thông tin:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="row g-4">

                {{-- CỘT TRÁI: THÔNG TIN GIAO HÀNG --}}
                <div class="col-lg-7">

                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="fw-bold mb-4 pb-3 border-bottom"
                            style="color: #114b3e;">
                            📦 Thông tin giao hàng
                        </h5>

                        {{-- Họ tên --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                Họ và tên người nhận <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $khachHang->ho_ten ?? '') }}"
                                placeholder="Nhập họ và tên người nhận"
                                maxlength="255"
                                required
                            >

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Số điện thoại --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">
                                Số điện thoại <span class="text-danger">*</span>
                            </label>

                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $khachHang->so_dien_thoai ?? '') }}"
                                placeholder="Nhập số điện thoại nhận hàng"
                                maxlength="20"
                                required
                            >

                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Địa chỉ --}}
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">
                                Địa chỉ giao hàng <span class="text-danger">*</span>
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                class="form-control @error('address') is-invalid @enderror"
                                rows="3"
                                maxlength="1000"
                                placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố"
                                required
                            >{{ old('address', $khachHang->dia_chi ?? '') }}</textarea>

                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ghi chú --}}
                        <div class="mb-0">
                            <label for="note" class="form-label fw-semibold">
                                Ghi chú đơn hàng
                                <span class="text-muted fw-normal">(Không bắt buộc)</span>
                            </label>

                            <textarea
                                id="note"
                                name="note"
                                class="form-control @error('note') is-invalid @enderror"
                                rows="2"
                                maxlength="2000"
                                placeholder="Lưu ý về thời gian hoặc địa điểm giao hàng..."
                            >{{ old('note') }}</textarea>

                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- PHƯƠNG THỨC THANH TOÁN --}}
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold mb-4 pb-3 border-bottom"
                            style="color: #114b3e;">
                            💰 Phương thức thanh toán
                        </h5>

                        {{-- COD --}}
                        <label
                            for="cod"
                            class="d-flex align-items-start gap-3 p-3 mb-3 rounded-3"
                            style="border: 1px solid #cfe3d6; background: #f5faf6; cursor: pointer;"
                        >
                            <input
                                type="radio"
                                name="payment_method"
                                id="cod"
                                value="cod"
                                class="form-check-input mt-1"
                                {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}
                            >

                            <span>
                                <strong class="d-block text-dark">
                                    Thanh toán khi nhận hàng (COD)
                                </strong>
                                <small class="text-muted">
                                    Thanh toán bằng tiền mặt khi nhận được sách.
                                </small>
                            </span>
                        </label>

                        {{-- Chuyển khoản --}}
                        <label
                            for="banking"
                            class="d-flex align-items-start gap-3 p-3 rounded-3"
                            style="border: 1px solid #dee2e6; background: #fff; cursor: pointer;"
                        >
                            <input
                                type="radio"
                                name="payment_method"
                                id="banking"
                                value="banking"
                                class="form-check-input mt-1"
                                {{ old('payment_method') === 'banking' ? 'checked' : '' }}
                            >

                            <span>
                                <strong class="d-block text-dark">
                                    Chuyển khoản ngân hàng
                                </strong>
                                <small class="text-muted">
                                    Phương thức chuyển khoản cần thực hiện theo hướng dẫn của cửa hàng.
                                </small>
                            </span>
                        </label>
                    </div>

                </div>

                {{-- CỘT PHẢI: TÓM TẮT ĐƠN HÀNG --}}
                <div class="col-lg-5">

                    <div
                        class="card border-0 shadow-sm rounded-4 p-4"
                        style="position: sticky; top: 20px;"
                    >
                        <h5 class="fw-bold mb-4 pb-3 border-bottom"
                            style="color: #114b3e;">
                            🛒 Đơn hàng của bạn
                        </h5>

                        {{-- Danh sách sản phẩm trong giỏ --}}
                        <div class="mb-3">
                            @foreach ($cart as $id => $item)
                                <div
                                    class="d-flex justify-content-between align-items-start gap-3 mb-3"
                                >
                                    <div class="d-flex align-items-start gap-3">

                                        @if (!empty($item['hinh_anh']))
                                            <img
                                                src="{{ asset('storage/' . ltrim($item['hinh_anh'], '/')) }}"
                                                alt="{{ $item['ten_san_pham'] }}"
                                                style="width: 52px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;"
                                                onerror="this.style.display='none';"
                                            >
                                        @else
                                            <div
                                                style="width: 52px; height: 70px; display: flex; align-items: center; justify-content: center; background: #f3f5f3; border-radius: 6px;"
                                            >
                                                📚
                                            </div>
                                        @endif

                                        <div>
                                            <div class="fw-semibold text-dark"
                                                 style="font-size: 14px; line-height: 1.5;">
                                                {{ $item['ten_san_pham'] }}
                                            </div>

                                            <small class="text-muted">
                                                Số lượng: {{ $item['so_luong'] }}
                                            </small>

                                            <div class="text-muted mt-1"
                                                 style="font-size: 12px;">
                                                {{ number_format($item['gia_ban'], 0, ',', '.') }}₫ / cuốn
                                            </div>
                                        </div>
                                    </div>

                                    <strong class="text-nowrap"
                                            style="font-size: 14px; color: #114b3e;">
                                        {{ number_format($item['gia_ban'] * $item['so_luong'], 0, ',', '.') }}₫
                                    </strong>
                                </div>
                            @endforeach
                        </div>

                        <hr style="border-color: #e5e7eb;">

                        {{-- Tạm tính --}}
                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <span class="text-muted">Tạm tính</span>
                            <strong>
                                {{ number_format($total, 0, ',', '.') }}₫
                            </strong>
                        </div>

                        {{-- Phí vận chuyển --}}
                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <span class="text-muted">Phí vận chuyển</span>
                            <strong class="text-success">Miễn phí</strong>
                        </div>

                        <hr style="border-color: #e5e7eb;">

                        {{-- Tổng cộng --}}
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                            <span class="fw-bold text-dark">Tổng cộng</span>

                            <strong
                                class="text-end"
                                style="font-size: 23px; color: #dc3545;"
                            >
                                {{ number_format($total, 0, ',', '.') }}₫
                            </strong>
                        </div>

                        {{-- Đặt hàng --}}
                        <button
                            type="submit"
                            class="btn w-100 py-3 text-white fw-bold"
                            style="background-color: #114b3e; border-radius: 8px;"
                        >
                            ĐẶT HÀNG NGAY →
                        </button>

                        <a
                            href="{{ route('cart.index') }}"
                            class="btn btn-outline-secondary w-100 py-2 mt-3"
                            style="border-radius: 8px;"
                        >
                            ← Quay lại giỏ hàng
                        </a>

                        <div class="text-center text-muted mt-3"
                             style="font-size: 12px;">
                            🔒 Thông tin của bạn được sử dụng để xử lý đơn hàng.
                        </div>
                    </div>

                </div>

            </div>
        </form>

    </div>
</div>
@endsection
