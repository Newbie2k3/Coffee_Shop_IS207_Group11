<div class="cart-sm">
    {{-- In work, do what you enjoy. --}}
    @foreach ($cart_items as $row)
        <div class="cart-sm-item">
            <h4 class="name">{{ $row->name }}</h4>
            <span class="price">{{ number_format($row->price, 0, ',', '.') . 'đ' }}</span>
            <div class="btn-group cart-qty" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary">-</button>
                <button type="button" class="btn btn-secondary">{{ $row->qty }}</button>
                <button type="button" class="btn btn-secondary">+</button>
            </div>
        </div>
    @endforeach

    <h3>{{ Cart::subtotal() }}</h3>
</div>
