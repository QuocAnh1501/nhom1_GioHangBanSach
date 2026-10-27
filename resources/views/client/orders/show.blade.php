@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container py-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                Chi tiết đơn hàng #{{ $order->ma_donhang }}
            </h2>

            <p class="text-muted mb-0">
                Ngày đặt:
                {{ \Illuminate\Support\Carbon::parse($order->ngay_dat)->format('d/m/Y H:i') }}
            </p>
        </div>

        <a href="{{ route('client.orders.index') }}"
           class="btn btn-outline-secondary">
            ← Lịch sử đơn hàng
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Thông tin đơn hàng</h5>

                    <p>
                        <strong>Trạng thái:</strong><br>
                        {{ $order->trangThai->ten_trangthai ?? 'Chưa xác định' }}
                    </p>

                    <p>
                        <strong>Phương thức thanh toán:</strong><br>
                        {{ $order->phuong_thuc_thanh_toan === 'banking'
                            ? 'Chuyển khoản ngân hàng'
                            : 'Thanh toán khi nhận hàng (COD)' }}
                    </p>

                    <p class="mb-2">
                        <strong>Thông tin giao hàng:</strong>
                    </p>

                    <div class="bg-light rounded p-3"
                         style="white-space: pre-line; overflow-wrap: anywhere;">{{ $order->ghi_chu ?: 'Không có thông tin giao hàng.' }}</div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Tổng tiền</span>

                        <span class="fs-4 fw-bold text-danger">
                            {{ number_format($order->tong_tien, 0, ',', '.') }}đ
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Sản phẩm đã đặt</h5>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">SL</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($order->chiTiet as $detail)
                                    <tr>
                                        <td>
                                            {{ $detail->sanPham->ten_san_pham ?? 'Sản phẩm không còn tồn tại' }}
                                        </td>

                                        <td class="text-center">
                                            {{ $detail->so_luong }}
                                        </td>

                                        <td class="text-end">
                                            {{ number_format($detail->don_gia, 0, ',', '.') }}đ
                                        </td>

                                        <td class="text-end">
                                            {{ number_format($detail->thanh_tien, 0, ',', '.') }}đ
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            Không có chi tiết sản phẩm.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4">
        <a href="{{ route('home') }}"
           class="btn btn-primary">
            Tiếp tục mua sắm
        </a>
    </div>

</div>
@endsection