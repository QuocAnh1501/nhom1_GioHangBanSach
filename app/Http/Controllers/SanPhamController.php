<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm và tìm kiếm sách.
     */
    public function index(Request $request)
    {
        // Khởi tạo truy vấn, chỉ lấy sản phẩm đang hoạt động
        $query = SanPham::where('trang_thai', 1);

        // Tìm kiếm theo tên sách hoặc tác giả
        if ($request->filled('q')) {
            $tuKhoa = trim($request->input('q'));

            $query->where(function ($query) use ($tuKhoa) {
                $query->where(
                    'ten_san_pham',
                    'like',
                    '%' . $tuKhoa . '%'
                )->orWhere(
                    'tac_gia',
                    'like',
                    '%' . $tuKhoa . '%'
                );
            });
        }

        // Sắp xếp sản phẩm mới nhất lên đầu
        $sanPhams = $query
            ->orderBy('ma_sanpham', 'desc')
            ->get();

        // Trả dữ liệu sang giao diện trang chủ
        return view('home', compact('sanPhams'));
    }
}
