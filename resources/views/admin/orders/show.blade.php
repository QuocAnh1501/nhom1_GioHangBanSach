@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container py-4">

    {{-- Tiêu đề --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Chi tiết đơn hàng #{{ $order->ma_donhang }}</h2>
            <p class="text-muted mb-0">
                Ngày đặt:
                {{ \Illuminate\Support\Carbon::parse($order->ngay_dat)->format('d/m/Y H:i') }}
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="btn btn-outline-secondary">
            ← Quay lại danh sách
        </a>
    </div>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="row g-4">

        {{-- Thông tin đơn hàng --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Thông tin đơn hàng</h5>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-5 text-muted">Mã đơn hàng</div>
                        <div class="col-sm-7 fw-bold">
                            #{{ $order->ma_donhang }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-5 text-muted">Ngày đặt</div>
                        <div class="col-sm-7">
                            {{ \Illuminate\Support\Carbon::parse($order->ngay_dat)->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-5 text-muted">Khách hàng</div>
                        <div class="col-sm-7">
                            {{ $order->khachHang->ho_ten ?? 'Khách vãng lai' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-5 text-muted">Email tài khoản</div>
                        <div class="col-sm-7">
                            {{ $order->khachHang->email ?? 'Không có tài khoản liên kết' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-5 text-muted">Phương thức thanh toán</div>
                        <div class="col-sm-7">
                            @if($order->phuong_thuc_thanh_toan === 'banking')
                                <span class="badge bg-primary">Chuyển khoản</span>
                            @else
                                <span class="badge bg-secondary">Thanh toán khi nhận hàng (COD)</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">Thông tin giao hàng</h6>

                    <div class="bg-light rounded p-3" style="white-space: pre-line; overflow-wrap: anywhere;">{{ $order->ghi_chu ?: 'Không có thông tin giao hàng.' }}</div>
                </div>
            </div>
        </div>

        {{-- Cập nhật trạng thái --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Trạng thái đơn hàng</h5>
                </div>

                <div class="card-body">
                    <p class="text-muted">Trạng thái hiện tại</p>

                    <h5 class="mb-4">
                        <span class="badge bg-info text-dark">
                            {{ $order->trangThai->ten_trangthai ?? 'Chưa xác định' }}
                        </span>
                    </h5>

                    <form action="{{ route('admin.orders.updateStatus', $order->ma_donhang) }}"
                          method="POST"
                          onsubmit="return confirm('Xác nhận cập nhật trạng thái đơn hàng?')">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="ma_trangthai" class="form-label">
                                Chọn trạng thái mới
                            </label>

                            <select name="ma_trangthai"
                                    id="ma_trangthai"
                                    class="form-select"
                                    required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->ma_trangthai }}"
                                        @selected((string) $order->ma_trangthai === (string) $status->ma_trangthai)>
                                        {{ $status->ten_trangthai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Cập nhật trạng thái
                        </button>
                    </form>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Tổng tiền đơn hàng</span>
                        <span class="fs-4 fw-bold text-danger">
                            {{ number_format($order->tong_tien, 0, ',', '.') }}đ
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chi tiết sản phẩm --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Sản phẩm trong đơn hàng</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($order->chiTiet as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            {{ $detail->ma_sanpham }}
                                        </td>

                                        <td>
                                            {{ $detail->sanPham->ten_san_pham ?? 'Sản phẩm không còn tồn tại' }}
                                        </td>

                                        <td class="text-center">
                                            {{ $detail->so_luong }}
                                        </td>

                                        <td class="text-end">
                                            {{ number_format($detail->don_gia, 0, ',', '.') }}đ
                                        </td>

                                        <td class="text-end fw-semibold">
                                            {{ number_format($detail->thanh_tien, 0, ',', '.') }}đ
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Đơn hàng chưa có chi tiết sản phẩm.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                            @if($order->chiTiet->isNotEmpty())
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-end">
                                            Tổng cộng
                                        </th>
                                        <th class="text-end text-danger fs-5">
                                            {{ number_format($order->tong_tien, 0, ',', '.') }}đ
                                        </th>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection