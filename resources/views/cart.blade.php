@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div style="max-width: 1000px; margin: 0 auto;">
        
        <!-- Tiêu đề giỏ hàng căn giữa tuyệt đối -->
        <h3 class="fw-bold mb-4" style="color: #114b3e; text-align: center; display: block; width: 100%;">
            🛒 Giỏ hàng của bạn
        </h3>

        <!-- Khung chứa bảng giỏ hàng -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
            <div class="table-responsive">
                <!-- table-layout: fixed giúp cố định tuyệt đối độ rộng các cột, không bị dính chữ -->
                <table class="table table-hover align-middle mb-0" style="width: 100%; table-layout: fixed;">
                    <thead class="text-white text-uppercase" style="background-color: #114b3e; font-size: 13px; letter-spacing: 0.5px;">
                        <tr>
                            <th scope="col" class="py-3 text-center" style="width: 50px;"></th>
                            <th scope="col" class="py-3 px-2" style="width: 110px;">Ảnh</th>
                            <th scope="col" class="py-3 px-2" style="width: 260px;">Sản phẩm</th>
                            <th scope="col" class="py-3 px-2" style="width: 140px;">Giá</th>
                            <th scope="col" class="py-3 px-2 text-center" style="width: 120px;">Số lượng</th>
                            <th scope="col" class="py-3 px-2" style="width: 140px;">Tổng</th>
                            <th scope="col" class="py-3 px-2 text-center" style="width: 80px;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center py-3" style="width: 50px;">
                                <input type="checkbox" style="transform: scale(1.2); cursor: pointer;">
                            </td>
                            <td class="px-2 py-3" style="width: 110px;">
                                <img src="{{ asset('images/book.jpg') }}" alt="Sách" class="rounded border shadow-sm" style="width: 65px; height: 90px; object-fit: cover;">
                            </td>
                            <td class="px-2 py-3 text-dark fw-bold" style="width: 260px; font-size: 15px;">
                                Sách gì đó
                            </td>
                            <td class="px-2 py-3 text-danger fw-semibold" style="width: 140px; font-size: 14px;">
                                180,000 VNĐ
                            </td>
                            <td class="px-2 py-3 text-center" style="width: 120px;">
                                <input type="number" value="1" min="1" style="width: 60px; padding: 6px; text-align: center; border: 1px solid #ced4da; border-radius: 6px; outline: none; font-size: 14px;">
                            </td>
                            <td class="px-2 py-3 text-dark fw-bold" style="width: 140px; font-size: 14px;">
                                180,000 VNĐ
                            </td>
                            <td class="px-2 py-3 text-center" style="width: 80px;">
                                <button type="button" title="Xóa sản phẩm" style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #dc3545; background: #fff; color: #dc3545; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;">
                                    ✕
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Khung tổng tiền và nút tiến hành thanh toán -->
        <div style="background: #fff; padding: 22px 28px; border-radius: 8px; box-shadow: 0 .125rem .25rem rgba(0,0,0,.075); display: flex; flex-direction: column; align-items: flex-end; gap: 14px;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <span style="font-size: 16px; color: #495057; font-weight: 600;">Tổng tiền thanh toán:</span>
                <span style="font-size: 22px; font-weight: 700; color: #dc3545;">180,000 VNĐ</span>
            </div>
            <a href="{{ route('checkout') }}" style="display: inline-block; padding: 12px 30px; background-color: #114b3e; color: #fff; font-weight: 700; text-transform: uppercase; text-decoration: none; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center; transition: background 0.2s;">
                Tiến hành thanh toán
            </a>
        </div>

    </div>
</div>
@endsection