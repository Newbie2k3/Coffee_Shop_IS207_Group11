<x-guest-layout>
    <x-big-banner :imgUrl="'assets/img/backgrounds/home-bg.jpg'">
        <div id="empty_cart" style="display:none;">
            <img src="{{ asset('assets/img/empty-cart.png') }}" alt="Your Cart is Empty!">
            <div class="text">
                <h3>Giỏ hàng của bạn đang trống</h3>
                <p>Lựa chọn sản phẩm của mình nhé!</p>
            </div>
            <div class="links">
                <a href="{{ route('home') }}" class="btn btn-white btn-outline-white">Trang chủ</a>
                <a href="{{ route('menu') }}" class="btn btn-primary">Thực đơn</a>
            </div>
        </div>
        @if (count($cart_items) > 0)
            @php
                function formatPrice($price)
                {
                    return number_format($price, 0, ',', '.') . ' ₫';
                }
            @endphp

            <div id="filled_cart">
                <div class="row px-2">
                    <table class="py-2 col-12 col-md-9">
                        <thead>
                            <tr>
                                <th class="cart-item-name">Tên sản phẩm</th>
                                <th class="cart-item-price">Giá</th>
                                <th class="cart-item-qty">Số lượng</th>
                                <th class="cart-item-total">Thành tiền</th>
                                <th class="cart-item-action">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_items as $cart_item)
                                <tr class="cart_item_id_{{ $cart_item->id }}">
                                    <td class="cart-item-name">{{ $cart_item->product->name }}</td>
                                    <td class="cart-item-price">{{ formatPrice($cart_item->product->price) }}</td>
                                    <td class="cart-item-qty">
                                        <div class="input-group text-center mb-3 qty-group-btn">
                                            <button class="input-group-text decrement-btn"
                                                data-id={{ $cart_item->id }}>-</button>
                                            <input type="number" name="quantity"
                                                class="form-control qty-input text-center product_qty_{{ $cart_item->id }}"
                                                data-id={{ $cart_item->id }} value="{{ $cart_item->product_qty }}"
                                                min="1">
                                            <button class="input-group-text increment-btn"
                                                data-id={{ $cart_item->id }}>+</button>
                                        </div>
                                    </td>
                                    <td class="product_total_{{ $cart_item->id }} cart-item-total">
                                        {{ formatPrice($cart_item->product->price * $cart_item->product_qty) }}</td>
                                    <td class="cart-item-action">
                                        <button type="button" class="btn btn-secondary cart-update-btn"
                                            name="cart-update-btn" data-id={{ $cart_item->id }}>Cập nhật</button>
                                        <button type="button" class="btn btn-primary remove-from-cart"
                                            name="remove-from-cart" data-id={{ $cart_item->id }}>Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="py-5 checkout-container col-12 col-md-3 text-start">
                        <p class="mb-4">Tổng tiền: <span class="cart_total">{{ formatPrice($cart_total) }}</span></p>
                        {{-- <button class="btn btn-primary">Thanh toán</button> --}}
                        <a href="{{ route('payment.session') }}" class="btn btn-primary py-2 w-100 fs-6">Thanh toán</a>
                    </div>
                </div>
            </div>
        @endif
    </x-big-banner>
</x-guest-layout>
