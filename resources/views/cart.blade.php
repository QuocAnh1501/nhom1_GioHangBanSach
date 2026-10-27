<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ hàng - BookStore</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Top Navigation Header -->
    <header class="bg-emerald-700 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-2 font-bold text-2xl tracking-wide">
                <span class="bg-white text-emerald-700 px-2.5 py-1 rounded-md">B</span>
                <span>BookStore</span>
            </div>
            <nav class="flex items-center space-x-6 font-medium text-sm">
                <a href="{{ url('/') }}" class="hover:text-emerald-200 transition">Trang chủ</a>
                <a href="{{ route('cart') }}" class="hover:text-emerald-200 flex items-center gap-1 transition font-bold underline">
                    <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content: Giỏ hàng -->
    <main class="max-w-5xl mx-auto px-4 py-10 flex-1 w-full">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8 flex items-center justify-center gap-2">
            <i class="fa-solid fa-cart-shopping text-emerald-700"></i> Giỏ hàng của bạn
        </h2>

        <!-- Bảng hiển thị giỏ hàng -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-zinc-900 text-white text-sm">
                        <!-- Đã bỏ ô tích ở trên, giữ lại khoảng trống để khớp cột với các dòng dưới -->
                        <th class="py-3 px-4 text-center w-12"></th>
                        <th class="py-3 px-4 text-center">Ảnh</th>
                        <th class="py-3 px-4">Sản phẩm</th>
                        <th class="py-3 px-4">Giá</th>
                        <th class="py-3 px-4 text-center">Số lượng</th>
                        <th class="py-3 px-4">Tổng</th>
                        <th class="py-3 px-4 text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    <tr>
                        <!-- Checkbox chọn sản phẩm cụ thể ở dòng -->
                        <td class="py-3 px-4 text-center">
                            <input type="checkbox" checked class="w-4 h-4 text-emerald-600 rounded cursor-pointer">
                        </td>
                        <td class="py-3 px-4 text-center">
                            <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&q=80" 
                                 alt="Đắc Nhân Tâm" class="w-16 h-16 object-cover mx-auto rounded">
                        </td>
                        <td class="py-3 px-4 font-medium text-gray-800">Đắc Nhân Tâm</td>
                        <td class="py-3 px-4 text-red-600 font-semibold">85,000 VNĐ</td>
                        <td class="py-3 px-4 text-center">
                            <!-- Input số lượng dạng mũi tên lên xuống -->
                            <input type="number" value="1" min="1" 
                                   class="w-20 text-center border border-gray-300 rounded py-1 px-2 focus:outline-none focus:border-emerald-600">
                        </td>
                        <td class="py-3 px-4 text-emerald-700 font-bold">85,000 VNĐ</td>
                        <td class="py-3 px-4 text-center">
                            <button class="bg-red-600 hover:bg-red-700 text-white px-2.5 py-1.5 rounded text-xs transition">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tổng tiền và nút tiến hành thanh toán -->
        <div class="mt-6 flex flex-col items-end space-y-4">
            <div class="text-xl font-bold text-gray-800">
                Tổng tiền (các mục đã chọn): <span class="text-red-600">85,000 VNĐ</span>
            </div>
            <div>
                <button class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-2.5 px-6 rounded shadow transition">
                    Tiến hành thanh toán
                </button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-gray-300 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            &copy; 2026 BookStore. All rights reserved.
        </div>
    </footer>

</body>
</html>