<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = DonHang::with('user')->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(DonHang $order)
    {
        // Thay 'items.product' bằng tên relationship thực tế trong Model DonHang.php
        // Ví dụ: 'chiTietDonHangs.sanPham' hoặc 'chiTiets.sanPham'
        $order->load('chiTietDonHangs.sanPham');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, DonHang $order)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công!');
    }
}