@extends('layouts.app')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Quản lý đơn hàng</h2>
            <p class="text-muted mb-0">Danh sách đơn hàng của BookStore</p>
        </div>

        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            Về trang chủ
        </a>
    </div>

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

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.orders.index') }}" method="GET">
                <div class="row g-3">

                    <div class="col-md-5">
                        <label class="form-label">Mã đơn hàng</label>
                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Nhập mã đơn hàng..."
                            value="{{ request('keyword') }}"
                        >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>

                            @foreach($statuses as $status)
                                <option
                                    value="{{ $status->ma_trangthai }}"
                                    @selected((string) request('status') === (string) $status->ma_trangthai)
                                >
                                    {{ $status->ten_trangthai }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">
                            Tìm kiếm
                        </button>

                        <a href="{{ route('admin.orders.index') }}"
                           class="btn btn-outline-secondary">
                            Xóa lọc
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Thanh toán</th>
                            <th class="text-end">Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="fw-bold">
                                    #{{ $order->ma_donhang }}
                                </td>

                                <td>
                                    @if($order->khachHang)
                                        <div class="fw-semibold">
                                            {{ $order->khachHang->ho_ten }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $order->khachHang->email }}
                                        </small>
                                    @else
                                        <span class="text-muted">
                                            Khách vãng lai
                                        </span>
                                    @endif

                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($order->ghi_chu, 55) }}
                                    </div>
                                </td>

                                <td>
                                    {{ $order->ngay_dat
                                        ? \Illuminate\Support\Carbon::parse($order->ngay_dat)->format('d/m/Y H:i')
                                        : 'N/A' }}
                                </td>

                                <td>
                                    @if($order->phuong_thuc_thanh_toan === 'banking')
                                        <span class="badge bg-primary">
                                            Chuyển khoản
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            COD
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end fw-bold text-danger">
                                    {{ number_format($order->tong_tien, 0, ',', '.') }}đ
                                </td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $order->trangThai->ten_trangthai ?? 'Chưa xác định' }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <a
                                        href="{{ route('admin.orders.show', $order->ma_donhang) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <p class="text-muted mb-0">
                                        Chưa có đơn hàng nào.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>

        </div>
    </div>

</div>
@endsection