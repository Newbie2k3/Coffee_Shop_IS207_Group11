$(document).ready(function () {
    $("#price").on("change", function () {
        let inputValue = $(this).val();

        if (inputValue < 0) {
            inputValue = 1000;
        } else if (inputValue > 10000000) {
            inputValue = 10000000;
        }

        $(this).val(inputValue);
    });

    $("#quantity").on("change", function () {
        let inputValue = $(this).val();

        if (inputValue < 0) {
            inputValue = 0;
        } else if (inputValue > 10000) {
            inputValue = 10000;
        }

        $(this).val(inputValue);
    });

    $("#image").on("change", function () {
        const fileInput = this;
        const imageErrorDiv = $("#image-error");
        const allowedExtensions = /(\.jpeg|\.jpg|\.png|\.gif)$/i;
        const maxSizeInBytes = 2048 * 1024; // 2048 KB

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];

            // Kiểm tra loại ảnh
            if (!allowedExtensions.exec(file.name)) {
                imageErrorDiv.text(
                    "Ảnh phải có định dạng JPEG, JPG, PNG hoặc GIF."
                );
                fileInput.value = ""; // Đặt lại giá trị của trường input
                return;
            }

            // Kiểm tra kích thước ảnh
            if (file.size > maxSizeInBytes) {
                imageErrorDiv.text("Kích thước ảnh không được vượt quá 2MB.");
                fileInput.value = ""; // Đặt lại giá trị của trường input
                return;
            }

            // Nếu ảnh thỏa mãn điều kiện, xóa thông báo lỗi
            imageErrorDiv.text("");
        }
    });
});
