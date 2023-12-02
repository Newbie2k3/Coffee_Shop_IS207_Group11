$(document).ready(function () {
    updateCartCount();
    updateCart();

    $(".add-to-cart").click(handleAddToCart);
    $("#smallCartContainer").on(
        "click",
        ".remove-from-cart",
        handleRemoveFromCart
    );
    $(".remove-from-cart").click(handleRemoveFromCart);
    $(".qty-input").on("change", handleQtyInputChange);
    $(".increment-btn").click(handleIncrementBtn);
    $(".decrement-btn").click(handleDecrementBtn);

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
                swal("Thành công", "Thêm sản phẩm thành công.", "success");

                updateCartCount();
                updateCart();
            },
            error: function (error) {
                swal(
                    "Thất bại",
                    "Không thể thêm sản phẩm này vào giỏ hàng.",
                    "error"
                );
                console.log(error);
            },
        });
    }

    function handleUpdateCartQty(id, newQuantity) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "PUT",
            url: "/update-cart-qty",
            data: {
                id: id,
                new_quantity: newQuantity,
            },
            success: function (response) {
                updateCartItemTotal(id, response.itemTotal);
                updateCartTotal(response.cartTotal);
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

        const removedItemID = id;
        $(".cart_item_id_" + removedItemID).remove();

        $.ajax({
            method: "DELETE",
            url: "/remove-from-cart",
            data: {
                id: id,
            },
            success: function (response) {
                updateCartCount();
                updateCartTotal(response.cartTotal);
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function handleQtyInputChange(e) {
        e.preventDefault();
        const id = $(this).data("id");
        let cur_qty = parseInt($(this).val());

        if (cur_qty < 1) {
            cur_qty = 1;
        }

        $(this).val(cur_qty);
        if ($(this).hasClass("update-cart-qty")) {
            handleUpdateCartQty(id, cur_qty);
        }
    }

    function handleIncrementBtn(e) {
        e.preventDefault();
        const id = $(this).data("id");

        let cur_qty = parseInt($(".product_qty_" + id).val());
        cur_qty += 1;
        $(".product_qty_" + id).val(cur_qty);

        if ($(this).hasClass("update-cart-qty")) {
            handleUpdateCartQty(id, cur_qty);
        }
    }

    function handleDecrementBtn(e) {
        e.preventDefault();
        const id = $(this).data("id");

        let cur_qty = parseInt($(".product_qty_" + id).val());
        if (cur_qty > 1) {
            cur_qty -= 1;
        } else {
            cur_qty = 1;
        }

        $(".product_qty_" + id).val(cur_qty);
        if ($(this).hasClass("update-cart-qty")) {
            handleUpdateCartQty(id, cur_qty);
        }
    }

    function updateCartCount() {
        const emptyCart = $("#empty_cart");
        const filledCart = $("#filled_cart");
        $.ajax({
            url: "/get-cart-count",
            method: "GET",
            success: function (response) {
                const cartCount = response.cartCount;
                $("#cartCount").text(response.cartCount);
                $("#cartCount").toggleClass("badge cart-badge", cartCount >= 0);

                if (response.cartCount > 0) {
                    emptyCart.hide();
                    filledCart.show();
                } else {
                    emptyCart.show();
                    filledCart.hide();
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function updateCart() {
        const smallCart = $("#smallCartContainer");

        smallCart.empty();
        $.ajax({
            url: "/get-cart",
            method: "GET",
            success: function (response) {
                const cart_items = response.cartItems;
                const products = response.products;

                cart_items.forEach(function (item) {
                    const product = products.find(
                        (p) => p.id === item.product_id
                    );

                    const cartItemHtml = `
                        <div class="cart-sm-item cart_item_id_${item.id}">
                            <h4 class="name">${product.name} x${
                        item.product_qty
                    }</h4>
                            <span class="price">${formatPrice(
                                product.price
                            )}</span>
                            <button type="button" class="btn btn-secondary remove-from-cart" name="remove-from-cart"
                                data-id=${item.id}>Xóa</button>
                        </div>
                    `;

                    $("#smallCartContainer").append(cartItemHtml);
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function updateCartTotal(cartTotal) {
        $(".cart_total").text(formatPrice(cartTotal));
    }

    function updateCartItemTotal(id, totalPrice) {
        $(".product_total_" + id).text(formatPrice(totalPrice));
    }

    function formatPrice(price) {
        return new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        }).format(price);
    }
});
