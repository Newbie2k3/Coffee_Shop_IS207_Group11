<header class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <a class="navbar-brand" href="/">Home</a>
    <nav>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {{ request()->is('great-deals') ? 'active' : '' }}">
                    <a class="nav-link" href="/great-deals">Khuyến mãi</a>
                </li>
                <li class="nav-item {{ request()->is('menu') ? 'active' : '' }}">
                    <a class="nav-link" href="/menu">Thực đơn</a>
                </li>
                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                    <a class="nav-link" href="/about">Về chúng tôi</a>
                </li>
            </ul>
        </div>
    </nav>
    <a class="nav-link" href="/account">Tài khoản</a>
    <a class="nav-link" href="/cart">Giỏ hàng</a>
</header>