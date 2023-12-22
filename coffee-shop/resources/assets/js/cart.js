$(document).ready(function () {
    const isAuthenticated = $("#user-avatar").data("auth");
    const csrfToken = $('meta[name="csrf-token"]').attr("content");

    if (isAuthenticated) {
        updateCart();
        updateCartCount();
    }

    $(".add-to-cart").click(handleAddToCart);
    $(".remove-from-cart").click(handleRemoveFromCart);
    $("#small_cart, .remove-from-cart").on("click", ".remove-from-cart", handleRemoveFromCart);
    $(".cart-update-btn").click(handleUpdateItemQty);
    $(".qty-input").on("change", handleQtyInputChange);
    $(".increment-btn, .decrement-btn").click(handleQtyChange);

    function handleAddToCart(e) {
        e.preventDefault();

        if (!isAuthenticated) {
            showInfoMessage("Yêu cầu đăng nhập", "Xin lỗi vì sự bất tiện này, mong quý khách đăng nhập tài khoản ạ!");
            return;
        }

        const id = $(this).data("id");
        const product_id = $(".product_id_" + id).val();
        const product_qty = $(".product_qty_" + id).val();
        const addToCartButton = $(this);

        disableButton(addToCartButton, 'Đang thêm <i class="fa-solid fa-circle-notch fa-spin"></i>');

        $.ajaxSetup({ headers: { "X-CSRF-TOKEN": csrfToken } });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: { product_id, product_qty },
            success: function (response) {
                handleAddToCartSuccess(response, id);
            },
            error: function (error) {
                handleAjaxError(error, "Thất bại", "Không thể thêm sản phẩm này vào giỏ hàng");
            },
            complete: function () {
                enableButton(addToCartButton, 'Thêm vào giỏ');
            },
        });
    }

    function handleQtyChange(e) {
        e.preventDefault();
        const id = $(this).data("id");
        let curQty = parseInt($(".product_qty_" + id).val());

        curQty = handleQuantityChange(curQty, $(this).hasClass("increment-btn"));

        $(".product_qty_" + id).val(curQty);
    }

    function handleQtyInputChange(e) {
        e.preventDefault();
        const id = $(this).data("id");
        let curQty = parseInt($(this).val());

        handleQuantityInputChange($(this), curQty);
    }

    function handleUpdateItemQty(e) {
        e.preventDefault();
        const id = $(this).data("id");
        let productQty = parseInt($(".product_qty_" + id).val());
        const updateBtn = $(this);

        disableButton(updateBtn, 'Cập nhật <i class="fa-solid fa-circle-notch fa-spin"></i>');

        $.ajaxSetup({ headers: { "X-CSRF-TOKEN": csrfToken } });

        $.ajax({
            method: "PUT",
            url: "/update-item-qty",
            data: { id: id, product_qty: productQty },
            success: function (response) {
                handleUpdateItemQtySuccess(response, id);
            },
            error: function (error) {
                handleAjaxError(error, "Không đủ số lượng", error.responseJSON.message);
            },
            complete: function () {
                enableButton(updateBtn, 'Cập nhật');
            },
        });
    }

    function handleRemoveFromCart(e) {
        e.preventDefault();
        const id = $(this).data("id");
        const removeBtn = $(this);

        disableButton(removeBtn, 'Xoá <i class="fa-solid fa-circle-notch fa-spin"></i>');

        $.ajaxSetup({ headers: { "X-CSRF-TOKEN": csrfToken } });

        $.ajax({
            method: "DELETE",
            url: "/remove-from-cart",
            data: { id },
            success: function (response) {
                handleRemoveFromCartSuccess(response, id);
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function handleAddToCartSuccess(response, id) {
        const status = response.status;
        if (status == "warning") {
            showWarningMessage("Hết hàng", "Hãy trải nghiệm các sản phẩm khác");
        } else if (status == "not_enough") {
            showWarningMessage("Không đủ hàng", `Số lượng bạn cần đang hiện không còn đủ. Sản phẩm này chỉ còn: ${response.message}`);
        } else {
            showSuccessMessage("Thành công", response.status);
        }

        updateCartCount();
        updateCart();
    }

    function handleUpdateItemQtySuccess(response, id) {
        updateCartItemTotal(id, response.item_total);
        updateCartTotal(response.cart_total);
        updateCart();
    }

    function handleRemoveFromCartSuccess(response, id) {
        updateCartCount();
        updateCartTotal(response.cart_total);
        $(".cart_item_id_" + id).remove();
    }

    function updateCartCount() {
        const cartCountElement = $("#cart_count");
        const miniEmptyCart = $("#mini-empty_cart");
        const emptyCart = $("#empty_cart");
        const filledCart = $("#filled_cart");

        $.ajax({
            url: "/get-cart-count",
            method: "GET",
            success: function (response) {
                const cartCount = response.cart_count;
                toggleCartBadge(cartCountElement, cartCount);
                toggleCartContainers(miniEmptyCart, emptyCart, filledCart, cartCount);
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function updateCart() {
        const smallCart = $("#small_cart");

        smallCart.empty();
        $.ajax({
            url: "/get-cart",
            method: "GET",
            success: function (response) {
                const cartItems = response.cart_items;

                cartItems.forEach(function (item) {
                    const cartItemHtml = createCartItemHtml(item);
                    smallCart.append(cartItemHtml);
                });
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function createCartItemHtml(item) {
        return `
            <div class="cart-sm-item cart_item_id_${item.id}">
                <h4 class="name">${item.product.name} x${item.product_qty}</h4>
                <span class="price">${formatPrice(item.product.price)}</span>
                <button type="button" class="btn btn-secondary remove-from-cart" name="remove-from-cart"
                    data-id=${item.id}>Xóa</button>
            </div>
        `;
    }

    function updateCartTotal(cartTotal) {
        $(".cart_total").text(formatPrice(cartTotal));
    }

    function updateCartItemTotal(id, totalPrice) {
        $(".product_total_" + id).text(formatPrice(totalPrice));
    }

    function toggleCartBadge(element, cartCount) {
        element.toggleClass("badge cart-badge", cartCount >= 0);
        element.text(cartCount);
    }

    function toggleCartContainers(miniEmptyCart, emptyCart, filledCart, cartCount) {
        if (cartCount > 0) {
            miniEmptyCart.hide();
            emptyCart.hide();
            filledCart.show();
        } else {
            miniEmptyCart.show();
            emptyCart.show();
            filledCart.hide();
        }
    }

    function handleQuantityChange(curQty, isIncrement) {
        return isIncrement ? Math.min(99, curQty + 1) : Math.max(1, curQty - 1);
    }

    function handleQuantityInputChange(element, curQty) {
        if (!isNaN(curQty) && curQty >= 0 && curQty <= 99) {
            element.val(curQty);
        } else {
            element.val(1);
        }
    }

    function showSuccessMessage(title, message) {
        swal(title, message, "success");
    }

    function showWarningMessage(title, message) {
        swal(title, message, "warning");
    }

    function showInfoMessage(title, message) {
        swal(title, message, "info");
    }

    function disableButton(button, loadingText) {
        button.prop("disabled", true);
        button.html(loadingText);
    }

    function enableButton(button, buttonText) {
        button.prop("disabled", false);
        button.html(buttonText);
    }

    function handleAjaxError(error, title, errorMessage) {
        swal(title, errorMessage, "error");
        console.log(error);
    }

    function formatPrice(price) {
        return new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        }).format(price);
    }
});
