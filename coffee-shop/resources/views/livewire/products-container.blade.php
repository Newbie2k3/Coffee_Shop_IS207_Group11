<section>
    @if (session('message'))
        {{ session('message') }}
    @endif
    @foreach ($menu as $category)
        <div class="row mb-5">
            <h3 class="col-md-12 mb-3 heading-pricing">{{ $category['name'] }}</h3>

            @if (!empty($category['products']))
                @foreach ($category['products'] as $product)
                    <div class="col-md-12 mb-3 pb-3">
                        <h4>{{ $product['id'] }}</h4>
                        <h4>{{ $product['name'] }}</h4>
                        <h4>{{ $product['price'] }}</h4>
                        <h4>{{ $product['description'] }}</h4>
                        @if ($cart->where('id', $product['id'])->count())
                            In cart
                        @else
                            <form wire:submit.prevent="addToCart({{ $product['id'] }})" action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input wire:model="quantity.{{ $product['id'] }}" type="number">
                                <button type="submit">Add to cart</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @else
                <p>Hết hàng.</p>
            @endif
        </div>
    @endforeach
</section>
