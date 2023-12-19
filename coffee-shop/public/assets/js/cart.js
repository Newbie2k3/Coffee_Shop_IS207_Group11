$(document).ready(function () {
    const isAuthenticated = $("#user-avatar").data("auth");
    const csrfToken = $('meta[name="csrf-token"]').attr("content");

    if (isAuthenticated) {
        updateCart();
        updateCartCount();
    }

    $(".add-to-cart").click(handleAddToCart);
    $("#small_cart").on("click", ".remove-from-cart", handleRemoveFromCart);
    $(".remove-from-cart").click(handleRemoveFromCart);
    $(".cart-update-btn").click(handleUpdateItemQty);
    $(".qty-input").on("change", handleQtyInputChange);
    $(".increment-btn, .decrement-btn").click(handleQtyChange);

    function handleAddToCart(e) {
        e.preventDefault();

        const id = $(this).data("id");
        const product_id = $(".product_id_" + id).val();
        const product_qty = $(".product_qty_" + id).val();

        if (!isAuthenticated) {
            swal(
                "Yêu cầu đăng nhập",
                "Xin lỗi vì sự bất tiện này, mong quý khách đăng nhập tài khoản ạ!",
                "info"
            );
            return;
        }

        const addToCartButton = $(this);
        addToCartButton.prop("disabled", true);
        addToCartButton.html(
            'Đang thêm <i class="fa-solid fa-circle-notch fa-spin"></i>'
        );

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                product_id: +product_id,
                product_qty: +product_qty,
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
            complete: function () {
                addToCartButton.prop("disabled", false);
                addToCartButton.html("Thêm vào giỏ");
            },
        });
    }

    function handleQtyChange(e) {
        e.preventDefault();
        const id = $(this).data("id");
        let cur_qty = parseInt($(".product_qty_" + id).val());

        if ($(this).hasClass("increment-btn")) {
            cur_qty = Math.min(99, cur_qty + 1);
        } else {
            cur_qty = Math.max(1, cur_qty - 1);
        }

        $(".product_qty_" + id).val(cur_qty);
    }

    function handleQtyInputChange(e) {
        e.preventDefault();
        const id = $(this).data("id");
        let cur_qty = parseInt($(this).val());
        if (!isNaN(cur_qty) && cur_qty >= 0 && cur_qty <= 99) {
            $(this).val(cur_qty);
        } else {
            $(this).val(1);
        }
    }

    function handleUpdateItemQty(e) {
        e.preventDefault();
        const id = $(this).data("id");
        let product_qty = parseInt($(".product_qty_" + id).val());

        const updateBtn = $(this);
        updateBtn.prop("disabled", true);
        updateBtn.html(
            'Cập nhật <i class="fa-solid fa-circle-notch fa-spin"></i>'
        );

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
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
            complete: function () {
                updateBtn.prop("disabled", false);
                updateBtn.html("Cập nhật");
            },
        });
    }

    function handleRemoveFromCart(e) {
        e.preventDefault();
        const id = $(this).data("id");

        const removeBtn = $(this);
        removeBtn.prop("disabled", true);
        removeBtn.html('Xoá <i class="fa-solid fa-circle-notch fa-spin"></i>');

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        $.ajax({
            method: "DELETE",
            url: "/remove-from-cart",
            data: {
                id: id,
            },
            success: function (response) {
                updateCartCount();
                updateCartTotal(response.cart_total);
                const removed_item_id = id;
                $(".cart_item_id_" + removed_item_id).remove();
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function updateCartCount() {
        const empty_cart = $("#empty_cart");
        const mini_empty_cart = $("#mini-empty_cart");
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
                    mini_empty_cart.hide();
                    empty_cart.hide();
                    filled_cart.show();
                } else {
                    mini_empty_cart.show();
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

var paymentMethodSelect = document.getElementById("paymentMethodSelect");
var paymentMethodIdInput = document.getElementById("payment_method_id");
var cartId = document.getElementById("cart_id");
paymentMethodSelect.addEventListener("change", function () {
    var selectedValue = paymentMethodSelect.value;
    paymentMethodIdInput.value = selectedValue;
});

document.getElementById("createOrderForm").addEventListener("submit", (e) => {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    if (!paymentMethodIdInput.value) {
        alert("Vui lý chọn phúc thức thanh toán!");
        return;
    }
    if (+paymentMethodIdInput.value === 2) {
        $.ajax({
            url: "/payment-vnpay",
            method: "POST",
            cache: false,
            data: {
                payment_method_id: paymentMethodIdInput.value,
            },
            success: function (response) {
                console.log(response);
                window.location.href = response.url;
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
    if (+paymentMethodIdInput.value === 1) {
        $.ajax({
            url: "/create-order",
            method: "POST",
            cache: false,
            data: {
                payment_method_id: paymentMethodIdInput.value,
            },
            success: function (response, b, c) {
                console.log(response);
                console.log(b);
                console.log(c);
                alert("Thanh toán khi nhận hàng thành công!");
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
});
