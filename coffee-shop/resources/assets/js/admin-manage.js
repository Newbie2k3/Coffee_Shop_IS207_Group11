$(document).ready(function () {
    createTable();

    const documentObj = $(document);
    const deleteBtn = ".delete-btn";
    const saveBtn = ".save-btn";

    documentObj.off("click", deleteBtn).on("click", deleteBtn, handleDelete);
    documentObj.off("click", saveBtn).on("click", saveBtn, handleSave);

    function handleSave() {
        const saveBtn = $(this);

        disableButton(
            saveBtn,
            'Đang xử lý <i class="fa-solid fa-circle-notch fa-spin"></i>'
        );

        if (!isFormValid()) {
            enableButton(saveBtn, "Lưu");
            return;
        }

        $(this).closest("form").submit();
    }

    function isFormValid() {
        let validForm = true;
        $(".required-field").each(function () {
            const fieldValue = $(this).val();
            if (!fieldValue.trim()) {
                validForm = false;
                return false;
            }
        });
        return validForm;
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
        disableButton(
            deleteBtn,
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
                });
                enableButton(deleteBtn, "Xoá");
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
            }
        });
    }

    function createTable() {
        var priceColumnIndex = getTableColumnIndex("myTable", "price-column");

        if (priceColumnIndex !== -1) {
            $("#myTable").DataTable({
                columnDefs: [
                    {
                        targets: priceColumnIndex,
                        type: "numeric-comma",
                    },
                ],
            });

            $.fn.dataTable.ext.type.order["numeric-comma-pre"] = function (
                data
            ) {
                return parseFloat(
                    data.replace(/[^\d.-]/g, "").replace(",", ".")
                );
            };
        } else {
            $("#myTable").DataTable();
        }
    }

    function getTableColumnIndex(tableId, columnId) {
        var columnIndex = -1;

        $("#" + tableId + " th").each(function (index) {
            if ($(this).attr("id") === columnId) {
                columnIndex = index;
                return false;
            }
        });

        return columnIndex;
    }

    function updateIndexes() {
        $("#myTable tbody tr").each(function (index) {
            $(this)
                .find("td:first")
                .text(index + 1);
        });
    }

    function disableButton(button, loadingText) {
        button.prop("disabled", true);
        button.html(loadingText);
    }

    function enableButton(button, buttonText) {
        button.prop("disabled", false);
        button.html(buttonText);
    }
});
