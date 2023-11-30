<div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('assets/img/product/' . $product->image) }}" alt="{{ $product->image }}" width="350"
                height="350">
        </div>
        <div class="col-md-6">
            <div class="fs-5 my-5">
                <h2 class="display-5 fw-bolder">{{ $product->name }}</h2>
                <p class="description">{{ $product->description }}</p>
            </div>
            <div class="mb-2"><span>{{ $product->price }}đ</span></div>
            @if ($cart->where('id', $product->id)->count())
                In cart
            @else
                <form wire:submit.prevent="addToCart({{ $product->id }})" action="{{ route('cart.store') }}"
                    method="POST">
                    @csrf
                    <input wire:model="quantity" type="number">
                    <button type="submit" class="btn btn-danger">Add to cart</button>
                </form>
            @endif
        </div>
    </div>
</div>
