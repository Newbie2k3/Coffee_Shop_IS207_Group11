<section class="flex">

    <div>
        <img width="auto"
            src="https://raw.githubusercontent.com/letuyen2102/coffee_shop/letuyen-21522778/public/images/bg_2.jpg"
            alt="">
    </div>
    <div class="form bg-black py-4">
        <p class="mt-6 text-xl font-semibold text-white dark:text-white px-4">Tư vấn ngay<span id="loading-indicator"
                style="display: none;">đang gửi...</span></p>
        <form class="my-form px-4" id="leads-form">
            <div class="row">
                <div class="col">
                    <input type="text" id='name' name='name' placeholder="Họ và tên" required>
                </div>
                <div class="col">
                    <input type="text" id='email' name='email' placeholder="Email" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="tel" id="phone" name="phone" placeholder="Số điện thoại" required>
                </div>
                <div class="col">
                    <input type="text" id="address" name="address" placeholder="Địa chỉ" required>
                </div>
                <div>
                    <input type="text" id='desc' name='desc' placeholder="Để lại lời nhắn">
                </div>
            </div>
            <div class="form-group mt-2 my-form">
                <label for="product">Sản phẩm quan tâm:</label>
                <select class="product" id="product" name="product" required>
                    <option value="">Chọn sản phẩm</option>
                    @foreach ($product as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <input type="submit" value="Gửi ngay"> --}}
            <div class="form-group d-flex mt-5">
                <button id="submit-btn" type="button" class="btn btn-primary flex-grow-1">Gửi ngay</button>
            </div>
        </form>
    </div>
    @section('page-script')
        <script>
            const csrfToken = "{{ csrf_token() }}";
            const formUrl = "{{ route('guest.form') }}";
        </script>
        <script defer>
            $(document).ready(function() {
                $("#submit-btn").click(submitForm);

                function submitForm(e) {
                    e.preventDefault();

                    $("#loading-indicator").show();
                    $('#leads-form :input').prop('disabled', true);

                    const name = $("#name").val();
                    const email = $("#email").val();
                    const phone = $("#phone").val();
                    const address = $("#address").val();
                    const desc = $("#desc").val();
                    const product = $("#product").val();

                    const formData = {
                        name: name,
                        email: email,
                        phone: phone,
                        address: address,
                        desc: desc,
                        product: product
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
                        success: function(response) {
                            $("#loading-indicator").hide();
                            $('#leads-form :input').prop('disabled', false);
                            const status = response.success;
                            if (status) {
                                swal("Thành công", "Chúng tôi sẽ sớm liên hệ với bạn", "success");

                                document.getElementById('leads-form').reset();
                            } else {
                                swal(
                                    "Thất bại",
                                    "Không thể gửi form, hãy thử lại sau",
                                    "error"
                                );
                            }
                        },
                        error: function(error) {
                            $("#loading-indicator").hide();
                            $('#leads-form :input').prop('disabled', false);

                            swal(
                                "Thất bại",
                                "Không thể gửi form, hãy thử lại sau",
                                "error"
                            );
                        },
                    });
                };
            });
        </script>
    @endsection
</section>
