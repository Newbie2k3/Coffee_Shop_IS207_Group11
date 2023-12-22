$(document).ready(function () {
    $("#submit-btn").click(submitForm);

    function submitForm(e) {
        e.preventDefault();
        $(".error-message").remove();

        $("#loading-indicator").show();
        $("#leads-form :input").prop("disabled", true);

        const name = $("#name").val();
        const email = $("#email").val();
        const phone = $("#phone").val();
        const address = $("#address").val();
        const desc = $("#desc").val();
        const product = $("#product").val();

        let formError = false;
        if (name == "") {
            $("#loading-indicator").hide();
            $("#leads-form :input").prop("disabled", false);
            displayErrorMessage("#name", "Họ và tên không được trống");
            formError = true;
        }

        if (email == "") {
            $("#loading-indicator").hide();
            $("#leads-form :input").prop("disabled", false);
            displayErrorMessage("#email", "Email không được trống");
            formError = true;
        }

        if (phone == "") {
            $("#loading-indicator").hide();
            $("#leads-form :input").prop("disabled", false);
            displayErrorMessage("#phone", "Số điện thoại không được trống");
            formError = true;
        }

        if (product == "") {
            $("#loading-indicator").hide();
            $("#leads-form :input").prop("disabled", false);
            displayErrorMessage("#product", "Hãy chọn sản phẩm bạn quan tâm");
            formError = true;
        }

        if (formError) return;

        const formData = {
            name: name,
            email: email,
            phone: phone,
            address: address,
            desc: desc,
            product: product,
        };

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        $.ajax({
            method: "POST",
            url: formUrl,
            data: formData,
            success: function (response) {
                $("#loading-indicator").hide();
                $("#leads-form :input").prop("disabled", false);
                const status = response.success;
                if (status) {
                    swal(
                        "Thành công",
                        "Chúng tôi sẽ sớm liên hệ với bạn",
                        "success"
                    );

                    document.getElementById("leads-form").reset();
                } else {
                    swal(
                        "Thất bại",
                        "Không thể gửi form, hãy thử lại sau",
                        "error"
                    );
                }
            },
            error: function (error) {
                $("#loading-indicator").hide();
                $("#leads-form :input").prop("disabled", false);

                swal(
                    "Thất bại",
                    "Không thể gửi form, hãy thử lại sau",
                    "error"
                );
            },
        });
    }

    function displayErrorMessage(fieldId, message) {
        // Display error message below the field
        $(fieldId).after(
            `<div class="error-message text-red-500" style="color:red;"><i>*${message}</i></div>`
        );
    }
});
