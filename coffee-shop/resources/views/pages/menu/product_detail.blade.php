<x-guest-layout>
    <x-big-banner :imgUrl="'assets/img/backgrounds/home-bg.jpg'">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-12 col-md-6">
                    <img src="{{ asset('assets/img/product/' . $product->image) }}" alt="{{ $product->image }}" class="rounded" style="width:500px; height:500px">
                </div>
                <div class="col-md-6">
                    <h2 class="display-5 fw-bolder">{{ $product->name }}</h2>
                    <p class="desc">{{ $product->description }}</p>
                    <div class="fs-5 mb-5">
                        <span>{{ $product->price }}đ</span>
                    </div>
                    <label for="Quantity">Số lượng</label>
                    <div class="input-group text-center mb-3">
                        <button class="input-group-text decrement-btn" data-id={{ $product->id }}>-</button>
                        <input type="number" name="quantity" class="form-control qty-input text-center product_qty_{{ $product->id }}" value="1" min="1">
                        <button class="input-group-text increment-btn" data-id={{ $product->id }}>+</button>
                    </div>
                    <div class="d-flex">
                        <input type="hidden" value={{ $product->id }} class="product_id_{{ $product->id }}">
                        <button type="button" class="btn btn-primary add-to-cart" data-id={{ $product->id }}>Thêm vào giỏ</button>
                    </div>
                </div>
            </div>
        </div>
    </x-big-banner>

    <!-- Related products -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bolder mb-4">Các sản phẩm liên quan</h2>
            @foreach ($related_product as $product)
                <div class="col-md-3 p-2">
                    <x-product-card id="{{ $product['id'] }}" imgUrl="{{ 'assets/img/product/' . $product['image'] }}"
                        name="{{ $product['name'] }}" price="{{ $product['price'] }}"
                        description="{{ $product['description'] }}" buttonName="Thêm vào giỏ" />
                </div>
            @endforeach
        </div>
    </section>
</x-guest-layout>
