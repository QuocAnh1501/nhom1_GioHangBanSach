<?php

namespace App\Http\Controllers;

use App\Models\SanPham;

class ChiTietSanPhamController extends Controller
{
    /**
     * Hiển thị thông tin chi tiết sản phẩm.
     */
    public function show($id)
    {
        // Tìm sản phẩm đang hoạt động theo mã sản phẩm
        $sanPham = SanPham::where('trang_thai', 1)
            ->findOrFail($id);

        // Trả dữ liệu sang giao diện chi tiết
        return view('sanpham.chitiet', compact('sanPham'));
    }
}
