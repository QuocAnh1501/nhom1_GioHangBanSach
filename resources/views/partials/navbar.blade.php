<nav class="main-navbar">
    <div class="navbar-container">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="navbar-logo">
            <span class="logo-icon">B</span>
            <span>BookStore</span>
        </a>

        {{-- Menu chính --}}
        <ul class="navbar-menu">

            {{-- Danh mục sách --}}
            <li>
                <a href="{{ route('sanpham.index') }}" class="nav-link">
                    Danh mục sách
                    <span class="dropdown-arrow">▾</span>
                </a>
            </li>

            {{-- Sách mới --}}
            <li>
                <a href="{{ route('sanpham.index') }}" class="nav-link">
                    Sách mới
                </a>
            </li>

            {{-- Sách bán chạy --}}
            <li>
                <a href="{{ route('sanpham.index') }}" class="nav-link">
                    Sách bán chạy
                </a>
            </li>

            {{-- Giỏ hàng --}}
            <li>
                <a href="{{ route('cart.index') }}" class="nav-link">
                    Giỏ hàng
                </a>
            </li>

            {{-- Đơn hàng của tôi: chỉ hiển thị cho khách hàng đã đăng nhập --}}
            @auth
                @if(auth()->user()->role !== 'admin')
                    <li>
                        <a href="{{ route('client.orders.index') }}" class="nav-link">
                            Đơn hàng của tôi
                        </a>
                    </li>
                @endif
            @endauth

            @auth
                {{-- Hiển thị khi đã đăng nhập --}}
                <li>
                    <a href="{{ route('home') }}" class="nav-link">
                        Xin chào, {{ Auth::user()->ho_ten }}
                    </a>
                </li>

                {{-- Đăng xuất --}}
                <li>
                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        style="display: inline;"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="nav-link"
                            style="background: none; border: none; cursor: pointer;"
                        >
                            Đăng xuất
                        </button>
                    </form>
                </li>
            @else
                {{-- Hiển thị khi chưa đăng nhập --}}
                <li>
                    <a href="{{ route('login') }}" class="nav-link">
                        Đăng nhập
                    </a>
                </li>

                <li>
                    <a href="{{ route('register') }}" class="nav-link">
                        Đăng ký
                    </a>
                </li>
            @endauth

        </ul>

    </div>
</nav>