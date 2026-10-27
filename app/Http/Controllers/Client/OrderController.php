<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\ChiTietDonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Hiển thị trang thanh toán.
     */
    public function checkout()
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()
            ->route('cart.index')
            ->with('error', 'Giỏ hàng của bạn đang trống.');
    }

    $total = 0;

    foreach ($cart as $item) {
        $total += $item['gia_ban'] * $item['so_luong'];
    }

    $khachHang = Auth::user();

    return view('checkout', compact('cart', 'total', 'khachHang'));
}

    /**
     * Xử lý đặt hàng.
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:1000'],
            'note' => ['nullable', 'string', 'max:2000'],
            'payment_method' => ['required', 'in:cod,banking'],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $order = DB::transaction(function () use ($cart, $validated) {
            $total = 0;
            $items = [];

            /*
             * Đọc lại giá và tồn kho từ database.
             * Không tin giá được lưu trong session.
             */
            foreach ($cart as $id => $item) {
                $productId = $item['ma_sanpham'] ?? $id;

                $product = SanPham::where('ma_sanpham', $productId)
                    ->lockForUpdate()
                    ->first();

                if (!$product || $product->trang_thai != 1) {
                    throw ValidationException::withMessages([
                        'cart' => 'Một sản phẩm trong giỏ hàng không còn khả dụng.',
                    ]);
                }

                $quantity = (int) ($item['so_luong'] ?? 0);

                if ($quantity < 1 || $quantity > $product->so_luong_ton) {
                    throw ValidationException::withMessages([
                        'cart' => 'Số lượng sản phẩm "' .
                            $product->ten_san_pham .
                            '" không hợp lệ hoặc đã vượt quá tồn kho.',
                    ]);
                }

                $price = (float) $product->gia_ban;
                $lineTotal = $price * $quantity;

                $total += $lineTotal;

                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $price,
                    'line_total' => $lineTotal,
                ];
            }

            /*
             * Lưu thông tin giao hàng trong ghi_chu vì
             * schema donhang hiện tại không có cột địa chỉ riêng.
             */
            $noteParts = [
                'Người nhận: ' . $validated['name'],
                'Số điện thoại: ' . $validated['phone'],
                'Địa chỉ giao hàng: ' . $validated['address'],
            ];

            if (!empty($validated['note'])) {
                $noteParts[] = 'Ghi chú: ' . $validated['note'];
            }

            $order = DonHang::create([
                'ma_khachhang' => Auth::user()->ma_khachhang,
                'ngay_dat' => now(),
                'tong_tien' => $total,
                'ma_trangthai' => 1,
                'ghi_chu' => implode("\n", $noteParts),
                'phuong_thuc_thanh_toan' => $validated['payment_method'],
            ]);

            foreach ($items as $item) {
                ChiTietDonHang::create([
                    'ma_donhang' => $order->ma_donhang,
                    'ma_sanpham' => $item['product']->ma_sanpham,
                    'so_luong' => $item['quantity'],
                    'don_gia' => $item['price'],
                    'thanh_tien' => $item['line_total'],
                ]);

                $item['product']->so_luong_ton -= $item['quantity'];
                $item['product']->save();
            }

            return $order;
        });

        // Chỉ xóa giỏ hàng sau khi transaction thành công.
        session()->forget('cart');

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Đặt hàng thành công! Mã đơn hàng của bạn là #' .
                    $order->ma_donhang
            );
    }
}