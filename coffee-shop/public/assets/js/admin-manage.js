$(document).ready(function () {
    $("#myTable").DataTable();

    $(document)
        .off("click", ".delete-btn")
        .on("click", ".delete-btn", handleDelete);

    function handleDelete(e) {
        e.preventDefault();

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

                const itemId = $(this).data("id");
                const url = itemDeleteUrl.replace(":id", itemId);

                deleteItem(itemId, url, deleteBtn);
            }
        });
    }

    function deleteItem(itemId, url, deleteBtn) {
        deleteBtn.prop("disabled", true);
                deleteBtn.html(
                    'Xoá <i class="fa-solid fa-circle-notch fa-spin"></i>'
                );

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        $.ajax({
            method: "DELETE",
            url: url,
            success: function (response) {
                updateUIAfterDelete(itemId, response.remaining);
            },
            error: function (error) {
                swal({
                    title: "Thật bại!",
                    icon: "warning",
                    text: JSON.parse(error.responseText).message,
                })
                deleteBtn.prop("disabled", false);
                deleteBtn.html(
                    'Xoá'
                );
            },
        });
    }

    function updateUIAfterDelete(itemId, remaining) {
        swal({
            title: "Xóa thành công!",
            icon: "success",
        }).then(() => {
            $(".rowid_" + itemId).remove();
            if (remaining == 0) {
                const table = $("#myTable").DataTable();
                table.clear();
                table.rows.add($("#myTable" + "_body")).draw();
            } else {
                updateIndexes();
                // $("#myTable").DataTable().rows().invalidate().draw();
            }
        });
    }

    function updateIndexes() {
        $("#myTable tbody tr").each(function (index) {
            $(this)
                .find("td:first")
                .text(index + 1);
        });
    }
});
