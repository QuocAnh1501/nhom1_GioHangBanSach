<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Hiển thị giỏ hàng.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['gia_ban'] * $item['so_luong'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function add(Request $request, $id)
    {
        $sanPham = SanPham::findOrFail($id);

        if ($sanPham->trang_thai != 1) {
            return back()->with('error', 'Sản phẩm hiện không khả dụng.');
        }

        $validated = $request->validate([
            'so_luong' => ['nullable', 'integer', 'min:1'],
        ]);

        $soLuongThem = (int) ($validated['so_luong'] ?? 1);

        $cart = session()->get('cart', []);

        $cartKey = (string) $sanPham->ma_sanpham;

        $soLuongHienTai = $cart[$cartKey]['so_luong'] ?? 0;

        if ($soLuongHienTai + $soLuongThem > $sanPham->so_luong_ton) {
            return back()->with(
                'error',
                'Số lượng vượt quá hàng tồn kho.'
            );
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['so_luong'] += $soLuongThem;
        } else {
            $cart[$cartKey] = [
                'ma_sanpham' => $sanPham->ma_sanpham,
                'ten_san_pham' => $sanPham->ten_san_pham,
                'gia_ban' => (float) $sanPham->gia_ban,
                'hinh_anh' => $sanPham->hinh_anh,
                'so_luong' => $soLuongThem,
                'so_luong_ton' => $sanPham->so_luong_ton,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    /**
     * Cập nhật số lượng sản phẩm.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'so_luong' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session()->get('cart', []);

        $cartKey = (string) $id;

        if (!isset($cart[$cartKey])) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        $sanPham = SanPham::find($id);

        if (!$sanPham || $sanPham->trang_thai != 1) {
            unset($cart[$cartKey]);

            session()->put('cart', $cart);

            return redirect()
                ->route('cart.index')
                ->with('error', 'Sản phẩm không còn khả dụng.');
        }

        $soLuong = (int) $validated['so_luong'];

        if ($soLuong > $sanPham->so_luong_ton) {
            return back()->with(
                'error',
                'Số lượng vượt quá hàng tồn kho.'
            );
        }

        $cart[$cartKey]['so_luong'] = $soLuong;
        $cart[$cartKey]['gia_ban'] = (float) $sanPham->gia_ban;
        $cart[$cartKey]['so_luong_ton'] = $sanPham->so_luong_ton;

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã cập nhật giỏ hàng.');
    }

    /**
     * Xóa một sản phẩm khỏi giỏ hàng.
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[(string) $id]);

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    /**
     * Xóa toàn bộ giỏ hàng.
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã làm trống giỏ hàng.');
    }
}