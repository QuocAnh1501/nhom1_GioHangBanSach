```blade
<nav class="main-navbar">
    <div class="navbar-container">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="navbar-logo">
            <span class="logo-icon">B</span>
            <span>BookStore</span>
        </a>

        <!-- Menu chính -->
        <ul class="navbar-menu">
            <li>
                <a href="{{ url('/') }}" class="nav-link">
                    Trang chủ
                </a>
            </li>

            <li>
                <a href="#" class="nav-link">
                    Danh mục sách
                    <span class="dropdown-arrow">▾</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Sách văn học</a></li>
                    <li><a href="#">Sách kinh tế</a></li>
                    <li><a href="#">Sách kỹ năng</a></li>
                    <li><a href="#">Sách thiếu nhi</a></li>
                    <li><a href="#">Sách giáo khoa</a></li>
                </ul>
            </li>

            <li>
                <a href="#" class="nav-link">Sách mới</a>
            </li>

            <li>
                <a href="#" class="nav-link">Sách bán chạy</a>
            </li>

            <!-- Giỏ hàng -->
            <li class="nav-item-dropdown">
                <a href="#" class="nav-link">
                    Giỏ hàng
                    <span class="dropdown-arrow">▾</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Xem giỏ hàng</a></li>
                    <li><a href="#">Thêm sách</a></li>
                    <li><a href="#">Sửa số lượng</a></li>
                    <li><a href="#">Xóa sách</a></li>
                </ul>
            </li>

            <!-- Đơn hàng -->
            <li class="nav-item-dropdown">
                <a href="#" class="nav-link">
                    Đơn hàng
                    <span class="dropdown-arrow">▾</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Đặt hàng</a></li>
                    <li><a href="#">Theo dõi đơn hàng</a></li>
                    <li><a href="#">Hủy đơn hàng</a></li>
                </ul>
            </li>

            <!-- Tài khoản -->
            <li class="nav-item-dropdown">
                <a href="#" class="nav-link">
                    Tài khoản
                    <span class="dropdown-arrow">▾</span>
                </a>
                <ul class="dropdown-menu dropdown-right">
                    <li><a href="#">Đăng nhập</a></li>
                    <li><a href="#">Đăng ký</a></li>
                    <li><a href="#">Quản trị viên</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>