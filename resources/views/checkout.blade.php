@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div style="max-width: 1000px; margin: 0 auto;">
        
        <!-- Tiêu đề trang được ép ra giữa bằng CSS nội tuyến để đè mọi cấu hình chung -->
        <h3 class="fw-bold mb-4" style="color: #114b3e; text-align: center; display: block; width: 100%;">
            💳 Thanh toán đơn hàng
        </h3>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="row" style="margin-right: -12px; margin-left: -12px;">
                <!-- Cột trái: Thông tin nhận hàng & Phương thức thanh toán -->
                <div class="col-lg-7" style="padding: 0 12px;">
                    <!-- Khung thông tin giao hàng -->
                    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white mb-4">
                        <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: #114b3e;">
                            Thông tin giao hàng
                        </h5>
                        
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 6px;">Họ và tên người nhận</label>
                            <input type="text" name="name" placeholder="Nhập họ và tên..." required style="display: block; width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #ced4da; border-radius: 6px; outline: none;">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 6px;">Số điện thoại</label>
                            <input type="text" name="phone" placeholder="Nhập số điện thoại..." required style="display: block; width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #ced4da; border-radius: 6px; outline: none;">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 6px;">Địa chỉ giao hàng chi tiết</label>
                            <textarea name="address" rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố..." required style="display: block; width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #ced4da; border-radius: 6px; outline: none; resize: vertical;"></textarea>
                        </div>

                        <div style="margin-bottom: 0;">
                            <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 6px;">Ghi chú đơn hàng (Tùy chọn)</label>
                            <textarea name="note" rows="2" placeholder="Ghi chú về thời gian hoặc địa điểm giao hàng..." style="display: block; width: 100%; padding: 10px 14px; font-size: 14px; border: 1px solid #ced4da; border-radius: 6px; outline: none; resize: vertical;"></textarea>
                        </div>
                    </div>

                    <!-- Khung phương thức thanh toán -->
                    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white">
                        <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: #114b3e;">
                            Phương thức thanh toán
                        </h5>
                        
                        <div style="display: flex; align-items: flex-start; padding: 14px; border: 1px solid #dee2e6; border-radius: 6px; background-color: #f8f9fa; margin-bottom: 12px;">
                            <input type="radio" name="payment_method" id="cod" value="cod" checked style="margin-top: 4px; margin-right: 12px; transform: scale(1.2);">
                            <label for="cod" style="cursor: pointer; width: 100%;">
                                <span style="font-weight: 600; color: #212529; display: block;">Thanh toán khi nhận hàng (COD)</span>
                                <span style="font-size: 13px; color: #6c757d; display: block; margin-top: 2px;">Thanh toán bằng tiền mặt khi nhận hàng trực tiếp từ nhân viên giao hàng.</span>
                            </label>
                        </div>

                        <div style="display: flex; align-items: flex-start; padding: 14px; border: 1px solid #dee2e6; border-radius: 6px; background-color: #f8f9fa;">
                            <input type="radio" name="payment_method" id="banking" value="banking" style="margin-top: 4px; margin-right: 12px; transform: scale(1.2);">
                            <label for="banking" style="cursor: pointer; width: 100%;">
                                <span style="font-weight: 600; color: #212529; display: block;">Chuyển khoản ngân hàng</span>
                                <span style="font-size: 13px; color: #6c757d; display: block; margin-top: 2px;">Thanh toán qua quét mã QR hoặc số tài khoản ngân hàng của cửa hàng.</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Cột phải: Tóm tắt đơn hàng & Nút thao tác -->
                <div class="col-lg-5" style="padding: 0 12px;">
                    <div class="card border-0 shadow-sm rounded-3 p-4 bg-white sticky-top" style="top: 20px;">
                        <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: #114b3e;">
                            Đơn hàng của bạn
                        </h5>
                        
                        <!-- Sản phẩm tóm tắt -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                            <div>
                                <span style="font-weight: 600; color: #212529; display: block;">Sách gì đó</span>
                                <span style="font-size: 13px; color: #6c757d;">Số lượng: 1</span>
                            </div>
                            <span style="font-weight: 600; color: #dc3545;">180,000 VNĐ</span>
                        </div>

                        <hr style="border-color: #dee2e6; margin: 12px 0;">

                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="color: #6c757d;">Tạm tính:</span>
                            <span style="font-weight: 600;">180,000 VNĐ</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 14px;">
                            <span style="color: #6c757d;">Phí vận chuyển:</span>
                            <span style="font-weight: 600; color: #198754;">Miễn phí</span>
                        </div>

                        <hr style="border-color: #dee2e6; margin: 12px 0;">

                        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                            <span style="font-weight: 700; font-size: 18px; color: #212529;">Tổng cộng:</span>
                            <span style="font-weight: 700; font-size: 18px; color: #dc3545;">180,000 VNĐ</span>
                        </div>

                        <!-- Các nút bấm -->
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <button type="submit" style="display: block; width: 100%; padding: 12px; background-color: #114b3e; color: #fff; font-weight: 700; text-transform: uppercase; border: none; border-radius: 6px; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                Đặt hàng ngay
                            </button>
                            
                            <a href="{{ route('cart.index') }}" style="display: block; width: 100%; padding: 10px; background-color: #6c757d; color: #fff; font-weight: 600; text-align: center; text-decoration: none; border-radius: 6px;">
                                Quay lại giỏ hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection