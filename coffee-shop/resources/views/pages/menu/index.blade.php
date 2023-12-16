<x-guest-layout>
    @section('title', $title)

    <x-big-banner :imgUrl="'assets/img/backgrounds/menu-bg.jpg'">
        <div class="col-md-7 col-sm-12 text-center">
            <h1 class="mb-3 mt-5 bread">Sản phẩm</h1>
            <p class="breadcrumbs">
                <span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
                <span>Menu</span>
            </p>
        </div>
    </x-big-banner>

    <x-intro />

    <div class="container p-5">
        <ul class="nav nav-tabs" id="categoryTabs">
            @foreach ($menu as $key => $category)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }} h3" id="tab-{{ $key }}"
                        data-bs-toggle="tab" href="#{{ $key }}">{{ $category['name'] }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content mt-2" id="categoryTabsContent">
            @foreach ($menu as $key => $category)
                <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="{{ $key }}">
                    <div class="row mb-5">
                        <div class="category-info">
                            <h3 class="col-12 category-title">{{ $category['name'] }}</h3>
                            <p class="category-description">{{ $category['description'] }}</p>
                        </div>

                        @if (!empty($category['products']))
                            @foreach ($category['products'] as $product)
                                <div class="col-md-3 p-2">
                                    <x-product-card id="{{ $product['id'] }}"
                                        imgUrl="{{ 'assets/img/product/' . $product['image'] }}"
                                        name="{{ $product['name'] }}" price="{{ $product['price'] }}"
                                        buttonName="Thêm vào giỏ" />
                                </div>
                            @endforeach
                        @else
                            <p class="out-of-stock">Hết hàng.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
