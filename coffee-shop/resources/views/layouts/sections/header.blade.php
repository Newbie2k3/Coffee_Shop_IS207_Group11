<header class="p-3 text-white">
    <div class="container">
        <div class="overlay"></div>
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
            <a class="navbar-brand" href="{{ route('home') }}">Coffee<small>Shop</small></a>

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
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                @admin
                    <a href="{{ url('/admin') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @endadmin

                <a href="{{ route('profile.edit') }}">
                    {{ __(Auth::user()->name) }}
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
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
</header>
