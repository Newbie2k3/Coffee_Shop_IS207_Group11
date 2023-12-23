$(document).ready(function () {
    $("#price, #quantity").on("change", limitInputValue);

    $("#image").on("change", imageValidation);

    function limitInputValue(e) {
        const input = $(this);
        const minValue = $(this).attr("id") === "quantity" ? 0 : 1000;
        const maxValue = $(this).attr("id") === "quantity" ? 10000 : 10000000;

        let inputValue = input.val();

        if (inputValue < minValue) {
            inputValue = minValue;
        } else if (inputValue > maxValue) {
            inputValue = maxValue;
        }

        input.val(inputValue);
    }

    function imageValidation(e) {
        const fileInput = this;
        const imageErrorDiv = $("#image-error");
        const allowedExtensions = /(\.jpeg|\.jpg|\.png|\.gif)$/i;
        const maxSizeInBytes = 2048 * 1024; // 2048 KB

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];

            if (!allowedExtensions.exec(file.name)) {
                imageErrorDiv.text(
                    "Ảnh phải có định dạng JPEG, JPG, PNG hoặc GIF."
                );
                fileInput.value = "";
                return;
            }

            if (file.size > maxSizeInBytes) {
                imageErrorDiv.text("Kích thước ảnh không được vượt quá 2MB.");
                fileInput.value = "";
                return;
            }

            imageErrorDiv.text("");
        }
    }
});
