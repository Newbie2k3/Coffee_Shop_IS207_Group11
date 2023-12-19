$(document).ready(function () {
    $("#myTable").DataTable();

    $(document)
        .off("click", ".delete-btn")
        .on("click", ".delete-btn", handleDelete);

    $(document).off("click", ".save-btn").on("click", ".save-btn", handleSave);

    function handleSaveTest() {
        let validForm = true;
        let formData = {}; // Tạo một đối tượng để lưu trữ dữ liệu form.

        $(".required-field").each(function () {
            const fieldName = $(this).attr("name");
            const fieldValue = $(this).val();

            // Thêm dữ liệu vào đối tượng formData.
            formData[fieldName] = fieldValue;

            if (!fieldValue.trim()) {
                validForm = false;
                return false;
            }
        });

        if (!validForm) {
            return;
        }

        // Log dữ liệu ra console.
        console.log("Form Data:", formData);

        // Nếu bạn muốn tiếp tục thực hiện submit form, hãy bỏ comment dòng dưới đây.
        // $(this).closest("form").submit();

        const saveBtn = $(this);

        saveBtn.prop("disabled", true);
        saveBtn.html(
            'Đang xử lý <i class="fa-solid fa-circle-notch fa-spin"></i>'
        );
    }

    function handleSave() {
        const saveBtn = $(this);

        saveBtn.prop("disabled", true);
        saveBtn.html(
            'Đang xử lý <i class="fa-solid fa-circle-notch fa-spin"></i>'
        );
        
        let validForm = true;
        $(".required-field").each(function () {
            const fieldValue = $(this).val();
            if (!fieldValue.trim()) {
                validForm = false;
                return false;
            }
        });

        if (!validForm) {
            return;
        }

        $(this).closest("form").submit();
    }

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
        deleteBtn.html('Xoá <i class="fa-solid fa-circle-notch fa-spin"></i>');

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
                });
                deleteBtn.prop("disabled", false);
                deleteBtn.html("Xoá");
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