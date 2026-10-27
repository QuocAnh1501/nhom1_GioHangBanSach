@extends('layouts.app')

@section('title', 'Thanh toán chuyển khoản - BookStore')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5 text-center">

                    <div class="mb-3">
                        <span class="badge bg-success px-3 py-2">
                            THANH TOÁN CHUYỂN KHOẢN
                        </span>
                    </div>

                    <h3 class="fw-bold mb-2">
                        Quét mã QR để thanh toán
                    </h3>

                    <p class="text-muted">
                        Đơn hàng #{{ $donHang->ma_donhang }}
                    </p>

                    <div class="bg-light rounded-3 p-3 mb-4">
                        <div class="text-muted mb-1">
                            Tổng tiền thanh toán
                        </div>

                        <div class="fs-2 fw-bold text-danger">
                            {{ number_format($donHang->tong_tien, 0, ',', '.') }}đ
                        </div>
                    </div>

                    {{-- Mã QR được tạo từ thông tin đơn hàng --}}
                    <div class="border rounded-4 p-3 d-inline-block bg-white mb-3">
                        <img
                            src="{{ $qrUrl }}"
                            alt="QR thanh toán đơn hàng"
                            class="img-fluid"
                            style="width: 260px; max-width: 100%;"
                        >
                    </div>

                    <p class="text-muted small">
                        Sử dụng ứng dụng ngân hàng để quét mã QR.
                    </p>

                    <div class="text-start bg-light rounded-3 p-3 mt-4">

                        <div class="mb-3">
                            <div class="text-muted small">Ngân hàng</div>
                            <div class="fw-semibold">Vietcombank</div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small">Số tài khoản</div>
                            <div class="fw-semibold">9383415367</div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small">Chủ tài khoản</div>
                            <div class="fw-semibold">THACH CHI VINH</div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small">
                                Nội dung chuyển khoản
                            </div>

                            <div class="fw-bold text-primary">
                                {{ $description }}
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small">Số tiền</div>

                            <div class="fw-bold text-danger">
                                {{ number_format($donHang->tong_tien, 0, ',', '.') }}đ
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning text-start mt-4">
                        <strong>Lưu ý:</strong>
                        Đơn hàng chưa được xác nhận thanh toán tự động.
                        Vui lòng chỉ chuyển tiền sau khi kiểm tra chính xác
                        thông tin người nhận trong ứng dụng ngân hàng.
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('home') }}"
                           class="btn btn-dark">
                            Tiếp tục mua sắm
                        </a>

                        <a href="{{ route('cart.index') }}"
                           class="btn btn-outline-secondary">
                            Quay lại giỏ hàng
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection