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
                <a href="#" class="nav-link">Giỏ hàng</a>
            </li>

           @auth
            <!-- Hiển thị khi ĐÃ đăng nhập -->
            <li>
                <a href="{{ url('/') }}" class="nav-link">
                    Hi, {{ Auth::user()->name }}
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer;">
                        Đăng xuất
                    </button>
                </form>
            </li>
        @else
            <!-- Hiển thị khi CHƯA đăng nhập -->
            <li>
                <a href="{{ route('login') }}" class="nav-link">Đăng nhập</a>
            </li>
        @endauth
            
        </ul>

    </div>
</nav>