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
                <a href="{{ route('cart') }}" class="hover:text-emerald-200 flex items-center gap-1 transition">
                <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
                </a>
            </li>
            
        </ul>

    </div>
</nav>