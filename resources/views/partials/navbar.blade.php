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
                 <form action="#" method="GET" class="search-form" style="align-items: center">
                    <input
                        type="text"
                        name="q"
                        placeholder="Tìm kiếm sách, tác giả..."
                    >
                    <button class="navbar-button" type="submit">Tìm kiếm</button>
                </form>
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

             <li>
                <a href="{{ route('cart.index') }}" class="nav-link text-white">Giỏ hàng</a>
            </li>

            <li>
                <a href="#" class="nav-link">Đăng nhập</a>
            </li>
            
        </ul>

    </div>
</nav>