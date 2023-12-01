$(document).ready(function () {
    $(".add-to-cart").click(function (e) {
        e.preventDefault();

        const product_id = $(this)
            .closest(".product_data")
            .find(".product_id")
            .val();

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
            },
            success: function (response) {
                swal("Thành công", "Thêm sản phẩm thành công.", "success");
                console.log(response);
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
    });
});
