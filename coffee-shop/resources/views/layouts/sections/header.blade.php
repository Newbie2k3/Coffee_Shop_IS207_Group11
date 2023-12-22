<header x-data="{ open: false }" class="py-3 text-white">
    <div class="container px-3">
        <div class="overlay"></div>
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <a class="navbar-brand" href="{{ route('home') }}">Coffee<small>Shop</small></a>

            <ul class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex nav justify-content-center">
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

            <div class="hidden sm:-my-px sm:ms-10 sm:flex">
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
                                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                                @endadmin

                                <a href="{{ route('profile.edit') }}">
                                    Profile
                                </a>

                                <a href="{{ route('payment.history') }}">
                                    Personal Invoices
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
                        <a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i>&nbsp&nbspXem giỏ
                            hàng</a>
                    </x-icon-modal>
                    @auth
                        <span id="cart_count" class="badge cart-badge">0</span>
                    @endauth
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-white mt-3">
        <div class="p-4 bg-black">
            @if (Route::has('login'))
                <div id="user-avatar" data-auth="{{ Auth::check() ? 'true' : 'false' }}"></div>
                @auth
                    <h3 class="modal-title mb-3">{{ __(Auth::user()->name) }}
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
                        <a class="d-block py-2" width="100%" href="{{ route('dashboard.index') }}">Dashboard</a>
                    @endadmin

                    <a class="d-block py-2" width="100%" href="{{ route('profile.edit') }}">
                        Profile
                    </a>

                    <a class="d-block py-2" width="100%" href="{{ route('payment.history') }}">
                        Personal Invoices
                    </a>

                    <a class="d-block py-2" width="100%" href="{{ route('cart') }}">
                        Your Cart
                    </a>
                @else
                    <h3 class="modal-title">Coffee Shop</h3>
                    <a class="d-block py-2" width="100%" href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a class="d-block py-2" width="100%" href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('great-deals')" :active="request()->routeIs('great-deals')">
                {{ __('Khuyến mãi') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('menu')" :active="request()->routeIs('menu')">
                {{ __('Thực đơn') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{ __('Về chúng tôi') }}
            </x-responsive-nav-link>
        </div>

        @auth
            <form method="POST" action="{{ route('logout') }}" class="pt-2 pb-3 space-y-1">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        @endauth
    </div>
</header>
