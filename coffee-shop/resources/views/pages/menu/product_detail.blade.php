<x-guest-layout>
    <x-big-banner :imgUrl="'assets/img/backgrounds/home-bg.jpg'">
        <div class="container px-4 px-lg-5 my-5 product_data">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('assets/img/product/' . $product->image) }}" alt="{{ $product->image }}"
                        width="350" height="350">
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                    <h3>{{ $product->id }}</h3>
                    <div class="fs-5 mb-5">
                        <span>{{ $product->price }}đ</span>
                    </div>
                    <p class="desc">{{ $product->description }}</p>
                    <div class="d-flex">
                        <input type="hidden" value={{ $product->id }} class="product_id">
                        <button type="button" class="btn btn-primary add-to-cart">Thêm vào giỏ</button>
                    </div>
                </div>
            </div>
        </div>
    </x-big-banner>

    <!-- sản phẩm liên quan-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Các sản phẩm liên quan</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($related_product as $item)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset('assets/img/product/' . $item->image) }}"
                                alt="{{ $item->image }}" width="150px" height="150" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $item->name }}</h5>
                                    @php
                                        // dd($item->name);
                                    @endphp
                                    <!-- Product price-->
                                    {{ $item->price }}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                        href="{{ URL::to('/product_detail/' . $item->id) }}">Xem ngay</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-guest-layout>
