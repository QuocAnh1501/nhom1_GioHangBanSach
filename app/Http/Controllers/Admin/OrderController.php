<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\TrangThaiDonHang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Danh sách đơn hàng.
     */
    public function index(Request $request)
    {
        $query = DonHang::with(['khachHang', 'trangThai'])
            ->orderByDesc('ngay_dat');

        // Lọc theo trạng thái đơn hàng.
        if ($request->filled('status')) {
            $query->where('ma_trangthai', $request->status);
        }

        // Tìm theo mã đơn hàng.
        if ($request->filled('keyword')) {
            $keyword = trim($request->keyword);

            if (ctype_digit($keyword)) {
                $query->where('ma_donhang', (int) $keyword);
            }
        }

        $orders = $query->paginate(15)->withQueryString();

        $statuses = TrangThaiDonHang::orderBy('ma_trangthai')->get();

        return view('admin.orders.index', compact(
            'orders',
            'statuses'
        ));
    }

    /**
     * Xem chi tiết một đơn hàng.
     */
    public function show(DonHang $order)
    {
        $order->load([
            'khachHang',
            'trangThai',
            'chiTiet.sanPham',
        ]);

        $statuses = TrangThaiDonHang::orderBy('ma_trangthai')->get();

        return view('admin.orders.show', compact(
            'order',
            'statuses'
        ));
    }

    /**
     * Cập nhật trạng thái đơn hàng.
     */
    public function updateStatus(Request $request, DonHang $order)
    {
        $validated = $request->validate([
            'ma_trangthai' => [
                'required',
                Rule::exists('trang_thai_donhang', 'ma_trangthai'),
            ],
        ], [
            'ma_trangthai.required' => 'Vui lòng chọn trạng thái đơn hàng.',
            'ma_trangthai.exists' => 'Trạng thái đơn hàng không hợp lệ.',
        ]);

        $order->update([
            'ma_trangthai' => $validated['ma_trangthai'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}