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

    <section class="ftco-section py-5" style="padding: 72px;">
        <div class="container">
            @foreach ($menu as $category)
                <div class="row mb-5">
                    <h3 class="col-md-12 mb-3 heading-pricing">{{ $category['name'] }}</h3>

                    @if (!empty($category['products']))
                        @foreach ($category['products'] as $product)
                            <div class="col-md-6 mb-3 pb-3">
                                <x-menu-item id="{{ $product['id'] }}"
                                    imgUrl="{{ 'assets/img/product/' . $product['image'] }}"
                                    name="{{ $product['name'] }}" price="{{ $product['price'] }}"
                                    description="{{ $product['description'] }}" />
                            </div>
                        @endforeach
                    @else
                        <p>Hết hàng.</p>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <section class="container p-5">
        @foreach ($menu as $key => $category)
            <div class="row mb-5">
                <h3 class="col-md-12 mb-3 heading-pricing">{{ $category['name'] }}</h3>

                @if (!empty($category['products']))
                    @foreach ($category['products'] as $product)
                        <div class="col-md-3 p-2">
                            <x-product-card id="{{ $product['id'] }}"
                                    imgUrl="{{ 'assets/img/product/' . $product['image'] }}"
                                    name="{{ $product['name'] }}"
                                    price="{{ $product['price'] }}"
                                    description="{{ $product['description'] }}"
                                    buttonName="Thêm vào giỏ" />
                        </div>
                    @endforeach
                @else
                    <p>Hết hàng.</p>
                @endif
            </div>
        @endforeach
    </section>
</x-guest-layout>
