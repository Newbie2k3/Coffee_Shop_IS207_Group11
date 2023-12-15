<x-guest-layout>
    <x-big-banner :imgUrl="'assets/img/backgrounds/home-bg.jpg'">
        <div id="empty_cart" style="display:none;">
            Giỏ hàng trống.
        </div>
        @if (count($cart_items) > 0)
            <?php
            function formatPrice($price)
            {
                return number_format($price, 0, ',', '.') . ' ₫';
            }
            ?>
            <div id="filled_cart">
                <table>
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart_items as $cart_item)
                            <tr class="cart_item_id_{{ $cart_item->id }}">
                                <td>{{ $cart_item->product->name }}</td>
                                <td>{{ formatPrice($cart_item->product->price) }}</td>
                                <td>
                                    <div class="input-group text-center mb-3">
                                        <button class="input-group-text decrement-btn update-cart-qty"
                                            data-id={{ $cart_item->id }}>-</button>
                                        <input type="number" name="quantity"
                                            class="form-control qty-input text-center product_qty_{{ $cart_item->id }} update-cart-qty"
                                            data-id={{ $cart_item->id }} value="{{ $cart_item->product_qty }}"
                                            min="1">
                                        <button class="input-group-text increment-btn update-cart-qty"
                                            data-id={{ $cart_item->id }}>+</button>
                                    </div>
                                </td>
                                <td class="product_total_{{ $cart_item->id }}">
                                    {{ formatPrice($cart_item->product->price * $cart_item->product_qty) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary remove-from-cart"
                                        name="remove-from-cart" data-id={{ $cart_item->id }}>Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p>Tổng tiền: <span class="cart_total">{{ formatPrice($cart_total) }}</span></p>

                <a href="{{ route('order.index') }}">Thanh toán</a>
            </div>
        @endif
    </x-big-banner>
</x-guest-layout>
