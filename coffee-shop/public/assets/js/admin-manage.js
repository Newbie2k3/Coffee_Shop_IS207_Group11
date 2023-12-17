$(document).ready(function () {
    const productSearchUrl = "/admin/product-search";
    const productDeleteUrl = "/admin/product/:id";

    $(document)
        .off("click", "#search-btn")
        .on("click", "#search-btn", handleSearch);
    $(document)
        .off("click", ".delete-btn")
        .on("click", ".delete-btn", handleDelete);

    function handleSearch(e) {
        e.preventDefault();

        console.log("Search");

        const keyword = $("#search-input").val();
        const categoryId = $("#category").val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            method: "GET",
            url: productSearchUrl,
            data: {
                keyword: keyword,
                categoryId: categoryId,
            },
            success: function (response) {
                $("#product-list").html(response);
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function handleDelete(e) {
        e.preventDefault();

        const productId = $(this).data("id");
        const url = productDeleteUrl.replace(":id", productId);
        console.log(url);

        swal({
            title: "Bạn có chắc chắn muốn xóa?",
            text: "Sau khi xóa, bạn sẽ không thể khôi phục dữ liệu!",
            icon: "warning",
            buttons: {
                cancel: "Hủy",
                confirm: "Xóa",
            },
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                const deleteBtn = $(this);
                deleteBtn.prop("disabled", true);
                deleteBtn.html(
                    'Xoá <i class="fa-solid fa-circle-notch fa-spin"></i>'
                );

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });

                $.ajax({
                    method: "DELETE",
                    url: url,
                    complete: function (response) {
                        // =)) loi du van xoa thanh cong => complete thay vi success
                        swal({ title: "Xóa thành công!", icon: "success" });
                        $(".product_" + productId).remove();
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            }
        });
    }
});
