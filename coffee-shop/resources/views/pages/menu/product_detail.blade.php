<x-guest-layout>
    @section('page-style')
        @vite(['resources/assets/css/pages/product-detail.css'])
    @endsection

    <x-big-banner :imgUrl="'assets/img/backgrounds/home-bg.jpg'">
        <div class="container px-4 px-lg-5 my-5 product-detail">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-12 col-md-5">
                    <img src="{{ asset('assets/img/product/' . $product->image) }}" onerror="replaceImage(this)"
                        alt="{{ $product->name }}" class="rounded" style="width:420px; height:420px">
                </div>
                <div class="col-12 col-md-7 text-left product-info">
                    <h2 class="display-5 fw-bolder">{{ $product->name }}</h2>
                    <p class="desc">{{ $product->description }}</p>
                    <div class="fs-5 mb-5">
                        <span>{{ number_format($product->price, 0, ',', '.') . ' ₫' }}</span>
                    </div>
                    @if (!$product->status)
                        <div class="h3 fw-bold">Ngừng bán</div>
                    @else
                        <div class="big-input-group">
                            <div>Số lượng</div>
                            <div class="input-group text-center mb-3">
                                <button class="input-group-text decrement-btn" data-id={{ $product->id }}>-</button>
                                <input type="number" name="quantity"
                                    class="form-control qty-input text-center product_qty_{{ $product->id }}"
                                    value="1" min="1">
                                <button class="input-group-text increment-btn" data-id={{ $product->id }}>+</button>
                            </div>
                        </div>

                        <div class="d-flex">
                            <input type="hidden" value={{ $product->id }} class="product_id_{{ $product->id }}">
                            <button type="button" class="btn btn-primary add-to-cart" data-id={{ $product->id }}>
                                Thêm vào giỏ
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-big-banner>

    <!-- Related products -->
    <section id="relatedProducts" class="py-5">
        <div class="container">
            <h3 class="fw-bolder mb-4 text-white h3">Các sản phẩm liên quan</h3>
            <div class="row justify-content-start align-items-center g-2">
                @foreach ($related_product as $product)
                    <div class="col-12 col-md-3">
                        <x-product-card id="{{ $product['id'] }}"
                            imgUrl="{{ 'assets/img/product/' . $product['image'] }}" name="{{ $product['name'] }}"
                            price="{{ $product['price'] }}" buttonName="Thêm vào giỏ"
                            status="{{ $product['status'] }}" />
                    </div>
                @endforeach
            </div>

        </div>
    </section>
</x-guest-layout>
