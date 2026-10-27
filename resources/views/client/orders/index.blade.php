@extends('layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold">Đơn hàng của tôi</h2>
        <p class="text-muted mb-0">
            Theo dõi các đơn hàng bạn đã đặt tại BookStore.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Thanh toán</th>
                            <th class="text-end">Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="fw-bold">
                                    #{{ $order->ma_donhang }}
                                </td>

                                <td>
                                    {{ \Illuminate\Support\Carbon::parse($order->ngay_dat)->format('d/m/Y H:i') }}
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

                                <td>
                                    <a href="{{ route('client.orders.show', $order->ma_donhang) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p class="text-muted mb-3">
                                        Bạn chưa có đơn hàng nào.
                                    </p>

                                    <a href="{{ route('home') }}"
                                       class="btn btn-primary">
                                        Khám phá sách
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $orders->links() }}
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('home') }}"
           class="btn btn-outline-secondary">
            ← Tiếp tục mua sắm
        </a>
    </div>

</div>
@endsection