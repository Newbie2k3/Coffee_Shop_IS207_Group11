$(document).ready(function () {
    updateCart();
    updateCartCount();

    $(".add-to-cart").click(handleAddToCart);
    $("#small_cart").on("click", ".remove-from-cart", handleRemoveFromCart);
    $(".remove-from-cart").click(handleRemoveFromCart);
    $(".qty-input").on("change", handleQtyInputChange);
    $(".increment-btn, .decrement-btn").click(handleQtyChange);

    function handleAddToCart(e) {
        e.preventDefault();

        const id = $(this).data("id");
        const product_id = $(".product_id_" + id).val();
        const product_qty = $(".product_qty_" + id).val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                product_id: product_id,
                product_qty: product_qty,
            },
            success: function (response) {
                const status = response.status;
                if (status == "warning") {
                    swal(
                        "Hết hàng",
                        "Hãy trải nghiệm các sản phẩm khác",
                        "warning"
                    );
                } else {
                    swal("Thành công", response.status, "success");
                }
                updateCartCount();
                updateCart();
            },
            error: function (error) {
                swal(
                    "Thất bại",
                    "Không thể thêm sản phẩm này vào giỏ hàng",
                    "error"
                );
                console.log(error);
            },
        });
    }

    function handleQtyChange(e) {
        e.preventDefault();
        const id = $(this).data("id");
        let cur_qty = parseInt($(".product_qty_" + id).val());

        if ($(this).hasClass("increment-btn")) {
            cur_qty += 1;
        } else {
            cur_qty = Math.max(1, cur_qty - 1);
        }

        $(".product_qty_" + id).val(cur_qty);
        if ($(this).hasClass("update-cart-qty")) {
            handleUpdateItemQty(id, cur_qty);
        }
    }

    function handleQtyInputChange(e) {
        e.preventDefault();
        const id = $(this).data("id");
        let cur_qty = parseInt($(this).val());
        cur_qty = Math.max(1, cur_qty);

        $(this).val(cur_qty);
        if ($(this).hasClass("update-cart-qty")) {
            handleUpdateItemQty(id, cur_qty);
        }
    }

    function handleUpdateItemQty(id, product_qty) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "PUT",
            url: "/update-item-qty",
            data: {
                id: id,
                product_qty: product_qty,
            },
            success: function (response) {
                updateCartItemTotal(id, response.item_total);
                updateCartTotal(response.cart_total);
                updateCart();
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function handleRemoveFromCart(e) {
        e.preventDefault();
        const id = $(this).data("id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        const removed_item_id = id;
        $(".cart_item_id_" + removed_item_id).remove();

        $.ajax({
            method: "DELETE",
            url: "/remove-from-cart",
            data: {
                id: id,
            },
            success: function (response) {
                updateCartCount();
                updateCartTotal(response.cart_total);
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function updateCartCount() {
        const empty_cart = $("#empty_cart");
        const filled_cart = $("#filled_cart");

        $.ajax({
            url: "/get-cart-count",
            method: "GET",
            success: function (response) {
                const cart_count = response.cart_count;
                $("#cart_count").toggleClass(
                    "badge cart-badge",
                    cart_count >= 0
                );
                $("#cart_count").text(cart_count);

                if (cart_count > 0) {
                    empty_cart.hide();
                    filled_cart.show();
                } else {
                    empty_cart.show();
                    filled_cart.hide();
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function updateCart() {
        const small_cart = $("#small_cart");

        small_cart.empty();
        $.ajax({
            url: "/get-cart",
            method: "GET",
            success: function (response) {
                const cart_items = response.cart_items;
                // const cart_total = response.cart_total;

                cart_items.forEach(function (item) {
                    const cart_item_html = `
                        <div class="cart-sm-item cart_item_id_${item.id}">
                            <h4 class="name">${item.product.name} x${
                        item.product_qty
                    }</h4>
                            <span class="price">${formatPrice(
                                item.product.price
                            )}</span>
                            <button type="button" class="btn btn-secondary remove-from-cart" name="remove-from-cart"
                                data-id=${item.id}>Xóa</button>
                        </div>
                    `;

                    small_cart.append(cart_item_html);
                });
                // small_cart.append(`<span>Tổng tiền: ${cart_total} </span>`)
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function updateCartTotal(cart_total) {
        $(".cart_total").text(formatPrice(cart_total));
    }

    function updateCartItemTotal(id, total_price) {
        $(".product_total_" + id).text(formatPrice(total_price));
    }

    function formatPrice(price) {
        return new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        }).format(price);
    }
});
