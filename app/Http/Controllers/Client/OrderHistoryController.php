<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    /**
     * Hiển thị lịch sử đơn hàng của khách đang đăng nhập.
     */
    public function index()
    {
        $khachHang = Auth::user();

        $orders = DonHang::with('trangThai')
            ->where('ma_khachhang', $khachHang->ma_khachhang)
            ->orderByDesc('ngay_dat')
            ->paginate(10);

        return view('client.orders.index', compact('orders'));
    }

    /**
     * Xem chi tiết đơn hàng của chính khách hàng.
     */
    public function show($id)
    {
        $khachHang = Auth::user();

        $order = DonHang::with([
            'trangThai',
            'chiTiet.sanPham',
        ])
            ->where('ma_donhang', $id)
            ->where('ma_khachhang', $khachHang->ma_khachhang)
            ->firstOrFail();

        return view('client.orders.show', compact('order'));
    }
}