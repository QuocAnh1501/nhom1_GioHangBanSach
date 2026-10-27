<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm.
     */
    public function index()
    {
        $products = SanPham::orderBy('ma_sanpham', 'desc')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Hiển thị biểu mẫu thêm sản phẩm.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Lưu sản phẩm mới vào database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ma_danhmuc'     => 'required|integer',
            'ten_san_pham'   => 'required|string|max:255',
            'tac_gia'        => 'nullable|string|max:255',
            'nha_xuat_ban'   => 'nullable|string|max:255',
            'nam_xuat_ban'   => 'nullable|integer|min:1|max:2100',
            'isbn'           => 'nullable|string|max:50',
            'mo_ta'          => 'nullable|string',
            'gia_ban'        => 'required|numeric|min:0',
            'so_luong_ton'   => 'required|integer|min:0',
            'hinh_anh'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'trang_thai'     => 'required|in:0,1',
        ]);

        // Kiểm tra danh mục có tồn tại hay không.
        $danhMucTonTai = \Illuminate\Support\Facades\DB::table('danh_muc')
            ->where('ma_danhmuc', $validated['ma_danhmuc'])
            ->exists();

        if (!$danhMucTonTai) {
            return back()
                ->withErrors(['ma_danhmuc' => 'Danh mục không tồn tại.'])
                ->withInput();
        }

        // Lưu ảnh nếu người dùng tải lên.
        if ($request->hasFile('hinh_anh')) {
            $validated['hinh_anh'] = $request->file('hinh_anh')
                ->store('products', 'public');
        }

        SanPham::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Hiển thị biểu mẫu chỉnh sửa sản phẩm.
     */
    public function edit($id)
    {
        $product = SanPham::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Cập nhật thông tin sản phẩm.
     */
    public function update(Request $request, $id)
    {
        $product = SanPham::findOrFail($id);

        $validated = $request->validate([
            'ma_danhmuc'     => 'required|integer',
            'ten_san_pham'   => 'required|string|max:255',
            'tac_gia'        => 'nullable|string|max:255',
            'nha_xuat_ban'   => 'nullable|string|max:255',
            'nam_xuat_ban'   => 'nullable|integer|min:1|max:2100',
            'isbn'           => 'nullable|string|max:50',
            'mo_ta'          => 'nullable|string',
            'gia_ban'        => 'required|numeric|min:0',
            'so_luong_ton'   => 'required|integer|min:0',
            'hinh_anh'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'trang_thai'     => 'required|in:0,1',
        ]);

        $danhMucTonTai = \Illuminate\Support\Facades\DB::table('danh_muc')
            ->where('ma_danhmuc', $validated['ma_danhmuc'])
            ->exists();

        if (!$danhMucTonTai) {
            return back()
                ->withErrors(['ma_danhmuc' => 'Danh mục không tồn tại.'])
                ->withInput();
        }

        // Thay ảnh cũ nếu có ảnh mới.
        if ($request->hasFile('hinh_anh')) {
            if (
                $product->hinh_anh &&
                Storage::disk('public')->exists($product->hinh_anh)
            ) {
                Storage::disk('public')->delete($product->hinh_anh);
            }

            $validated['hinh_anh'] = $request->file('hinh_anh')
                ->store('products', 'public');
        } else {
            unset($validated['hinh_anh']);
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Xóa sản phẩm.
     */
    public function destroy($id)
    {
        $product = SanPham::findOrFail($id);

        // Xóa ảnh khỏi storage nếu có.
        if (
            $product->hinh_anh &&
            Storage::disk('public')->exists($product->hinh_anh)
        ) {
            Storage::disk('public')->delete($product->hinh_anh);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Xóa sản phẩm thành công!');
    }
}
