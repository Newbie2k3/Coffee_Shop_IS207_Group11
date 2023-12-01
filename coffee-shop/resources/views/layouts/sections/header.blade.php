<header class="p-3 text-white">
    <div class="container">
        <div class="overlay"></div>
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
            <a class="navbar-brand" href="{{ route('home') }}">Coffee<small>Shop</small></a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item {{ request()->is('great-deals') ? 'active' : '' }}">
                    <a class="nav-link px-3" href="/great-deals">Khuyến mãi</a>
                </li>
                <li class="nav-item {{ request()->is('menu') ? 'active' : '' }} dropdown">
                    <a class="nav-link px-3 dropdown-toggle" href="#" role="button" id="productsDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Sản phẩm
                    </a>
                    <div class="dropdown-menu" aria-labelledby="productsDropdown">
                        <a class="dropdown-item" href="/menu">Cà phê</a>
                        <a class="dropdown-item" href="/menu">Trà</a>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                    <a class="nav-link px-3" href="/about">Về chúng tôi</a>
                </li>
            </ul>

            <div class="d-flex">
                {{-- Account --}}
                <x-icon-modal menuOpen="accountMenuOpen" icon='<i class="fa-solid fa-user"></i>' size='small'>
                    @if (Route::has('login'))
                        @auth
                            <h3 class="modal-title">{{ __(Auth::user()->name) }}
                                <br>
                                <span class="modal-subtitle">
                                    @if (Auth::user()->is_admin)
                                        Admin
                                    @else
                                        Guest
                                    @endif
                                </span>
                            </h3>

                            @admin
                                <a href="{{ url('/admin') }}" class="">Dashboard</a>
                            @endadmin

                            <a href="{{ route('profile.edit') }}">
                                Profile
                            </a>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="route('logout')"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        @else
                            <h3 class="modal-title">Coffee Shop</h3>
                            <a href="{{ route('login') }}">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </x-icon-modal>

                {{-- Cart --}}
                <div class="position-relative">
                    <x-icon-modal menuOpen="cartMenuOpen" icon='<i class="fa-solid fa-cart-shopping"></i>'
                        size='medium'>
                        <h3 class="modal-title">Coffee Shop</h3>
                        {{-- ... (Nội dung của menu giỏ hàng) ... --}}
                        <a href="{{ route('cart') }}">Giỏ hàng</a>
                    </x-icon-modal>
                    <span class="badge cart-badge">4</span>
                </div>
            </div>
        </div>
    </div>
</header>
