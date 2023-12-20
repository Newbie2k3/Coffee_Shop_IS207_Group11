<header class="p-3 text-white">
    <div class="container">
        <div class="overlay"></div>
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
            <a class="navbar-brand" href="{{ route('home') }}">Coffee<small>Shop</small></a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item {{ request()->is('great-deals') ? 'active' : '' }}">
                    <a class="nav-link px-3" href="{{ route('great-deals') }}">Khuyến mãi</a>
                </li>
                <li class="nav-item {{ request()->is('menu') ? 'active' : '' }}">
                    <a class="nav-link px-3" href="{{ route('menu') }}">Thực đơn</a>
                </li>
                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                    <a class="nav-link px-3" href="{{ route('about') }}">Về chúng tôi</a>
                </li>
            </ul>

            <div class="d-flex">
                {{-- Account --}}
                <div class="icon-container">
                    <x-icon-modal menuOpen="accountMenuOpen" icon='<i class="fa-solid fa-user"></i>' size='small'>
                        @if (Route::has('login'))
                            <div id="user-avatar" data-auth="{{ Auth::check() ? 'true' : 'false' }}"></div>
                            @auth
                                <h3 class="modal-title">{{ __(Auth::user()->name) }}
                                    <br>
                                    <span class="modal-subtitle">
                                        @admin
                                            Admin
                                        @else
                                            Guest
                                        @endadmin
                                    </span>
                                </h3>

                                @admin
                                    <a href="{{ route('dashboard.index') }}" class="">Dashboard</a>
                                @endadmin

                                <a href="{{ route('profile.edit') }}">
                                    Profile
                                </a>

                                <a href="{{ route('payment.history') }}">
                                    Persona Invoices
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
                </div>

                {{-- Cart --}}
                <div class="icon-container">
                    <x-icon-modal menuOpen="cartMenuOpen" icon='<i class="fa-solid fa-cart-shopping"></i>'
                        size='medium'>
                        <h3 class="modal-title">Coffee Shop</h3>
                        <div class="cart-sm" id="small_cart">
                            {{-- Cart Items --}}
                        </div>
                        <div id="mini-empty_cart">
                            <img src="{{ asset('assets/img/empty-cart.png') }}" alt="Your Cart is Empty!">
                            <div class="text text-center">
                                <h3>Giỏ hàng của bạn đang trống</h3>
                                <p>Lựa chọn sản phẩm của mình nhé!</p>
                            </div>
                        </div>
                        <a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i>&nbsp&nbspXem giỏ hàng</a>
                    </x-icon-modal>
                    @auth
                        <span id="cart_count" class="badge cart-badge">0</span>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
