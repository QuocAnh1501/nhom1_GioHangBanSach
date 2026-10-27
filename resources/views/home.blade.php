@extends('layouts.app')

@section('title', 'Trang chủ - BookStore')

@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookStore - Cửa hàng sách trực tuyến</title>

    <!-- Tailwind CSS CDN để giao diện hiển thị đẹp ngay lập tức -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">


    <!-- Main Content Container -->
    <main class="max-w-7xl mx-auto px-4 py-8 flex-1 w-full">
        
        <!-- Tiêu đề phần sách -->
        <div class="mb-6 border-b border-gray-200 pb-3 flex justify-between items-end">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Sách Nổi Bật</h2>
                <p class="text-gray-500 text-sm mt-1">Khám phá những cuốn sách hay nhất dành cho bạn</p>
            </div>
            <a href="#" class="text-emerald-700 font-semibold text-sm hover:underline">Xem tất cả &rarr;</a>
        </div>

        <!-- Lưới danh sách các sản phẩm (Giả lập danh sách không dùng DB) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <!-- Cuốn sách 1 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&q=80" 
                         alt="Đắc Nhân Tâm" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <span class="text-xs font-semibold uppercase px-2 py-1 bg-emerald-100 text-emerald-800 rounded">Kỹ năng sống</span>
                        <h3 class="font-bold text-gray-800 text-lg mt-2 line-clamp-1">Đắc Nhân Tâm</h3>
                        <p class="text-gray-500 text-sm">Tác giả: Dale Carnegie</p>
                        <div class="mt-3 flex items-baseline space-x-2">
                            <span class="text-lg font-bold text-emerald-700">85.000đ</span>
                            <span class="text-xs text-gray-400 line-through">110.000đ</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 pt-0">
                    <button class="w-full bg-emerald-700 hover:bg-emerald-800 text-white py-2 px-4 rounded font-medium text-sm flex items-center justify-center gap-2 transition">
                        <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </div>
            </div>

            <!-- Cuốn sách 2 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=500&q=80" 
                         alt="Nhà Giả Kim" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <span class="text-xs font-semibold uppercase px-2 py-1 bg-emerald-100 text-emerald-800 rounded">Văn học</span>
                        <h3 class="font-bold text-gray-800 text-lg mt-2 line-clamp-1">Nhà Giả Kim</h3>
                        <p class="text-gray-500 text-sm">Tác giả: Paulo Coelho</p>
                        <div class="mt-3 flex items-baseline space-x-2">
                            <span class="text-lg font-bold text-emerald-700">79.000đ</span>
                            <span class="text-xs text-gray-400 line-through">99.000đ</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 pt-0">
                    <button class="w-full bg-emerald-700 hover:bg-emerald-800 text-white py-2 px-4 rounded font-medium text-sm flex items-center justify-center gap-2 transition">
                        <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </div>
            </div>

            <!-- Cuốn sách 3 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=500&q=80" 
                         alt="Tuổi Trẻ Đáng Giá Bao Nhiêu" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <span class="text-xs font-semibold uppercase px-2 py-1 bg-emerald-100 text-emerald-800 rounded">Tâm lý</span>
                        <h3 class="font-bold text-gray-800 text-lg mt-2 line-clamp-1">Tuổi Trẻ Đáng Giá Bao Nhiêu</h3>
                        <p class="text-gray-500 text-sm">Tác giả: Rosie Nguyễn</p>
                        <div class="mt-3 flex items-baseline space-x-2">
                            <span class="text-lg font-bold text-emerald-700">92.000đ</span>
                            <span class="text-xs text-gray-400 line-through">120.000đ</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 pt-0">
                    <button class="w-full bg-emerald-700 hover:bg-emerald-800 text-white py-2 px-4 rounded font-medium text-sm flex items-center justify-center gap-2 transition">
                        <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </div>
            </div>

            <!-- Cuốn sách 4 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?w=500&q=80" 
                         alt="Lập Trình PHP & Laravel" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <span class="text-xs font-semibold uppercase px-2 py-1 bg-emerald-100 text-emerald-800 rounded">Công nghệ</span>
                        <h3 class="font-bold text-gray-800 text-lg mt-2 line-clamp-1">Lập Trình Web Laravel</h3>
                        <p class="text-gray-500 text-sm">Tác giả: Nhóm Phát Triển</p>
                        <div class="mt-3 flex items-baseline space-x-2">
                            <span class="text-lg font-bold text-emerald-700">150.000đ</span>
                            <span class="text-xs text-gray-400 line-through">180.000đ</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 pt-0">
                    <button class="w-full bg-emerald-700 hover:bg-emerald-800 text-white py-2 px-4 rounded font-medium text-sm flex items-center justify-center gap-2 transition">
                        <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-gray-300 py-8">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h4 class="font-bold text-white text-lg mb-3">BookStore</h4>
                <p class="text-sm text-gray-400">Website bán sách trực tuyến, giúp bạn tìm kiếm những cuốn sách yêu thích nhanh chóng và dễ dàng.</p>
            </div>
            <div>
                <h4 class="font-bold text-white text-lg mb-3">Thông tin</h4>
                <ul class="text-sm space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">Giới thiệu</a></li>
                    <li><a href="#" class="hover:text-white">Chính sách bảo mật</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white text-lg mb-3">Hỗ trợ khách hàng</h4>
                <ul class="text-sm space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white">Hướng dẫn mua hàng</a></li>
                    <li><a href="#" class="hover:text-white">Chính sách giao hàng</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white text-lg mb-3">Liên hệ</h4>
                <p class="text-sm text-gray-400">Email: bookstore@example.com</p>
                <p class="text-sm text-gray-400">Điện thoại: 0123 456 789</p>
            </div>
        </div>
    </footer>

</body>
</html>
@endsection
