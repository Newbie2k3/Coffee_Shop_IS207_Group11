<header class="p-3 text-white">
    <div class="container">
        <div class="overlay"></div>
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
            <a class="navbar-brand" href="/home">Coffee<small>Shop</small></a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item {{ request()->is('great-deals') ? 'active' : '' }}">
                    <a class="nav-link px-3" href="/great-deals">Khuyến mãi</a>
                </li>
                <li class="nav-item {{ request()->is('menu') ? 'active' : '' }}">
                    <a class="nav-link px-3" href="/menu">Thực đơn</a>
                </li>
                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                    <a class="nav-link px-3" href="/about">Về chúng tôi</a>
                </li>
            </ul>

            <div class="d-flex">
                <a class="icon" href="/account">
                    <i class="fa-solid fa-user"></i>
                </a>
                <a class="icon" href="/cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </div>
    </div>
</header>
