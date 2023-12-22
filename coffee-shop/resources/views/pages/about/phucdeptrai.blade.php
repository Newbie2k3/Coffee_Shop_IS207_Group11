<section class="container p-0 m-0">
    <div class="row">
        <div class="col-12 col-md-5 p-0">
            <img style="height:100%; object-fit: cover;"
                src="https://raw.githubusercontent.com/letuyen2102/coffee_shop/letuyen-21522778/public/images/bg_2.jpg"
                alt="Form Image">
        </div>
        <div class="col-12 col-md-7 bg-black py-5 pe-5">
            <p class="text-xl font-semibold text-white dark:text-white px-4">Tư vấn ngay<span id="loading-indicator"
                    style="display: none; margin-left:4px;">đang gửi...</span></p>
            <form class="my-form px-4" id="leads-form">
                <div class="row" width="100%">
                    <div class="col-12 col-md-6">
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
                    <button id="submit-btn" type="button" class="btn btn-primary flex-grow-1 py-3 py-md-2">Gửi ngay</button>
                </div>
            </form>
        </div>
    </div>

    @section('page-script')
        <script>
            const csrfToken = "{{ csrf_token() }}";
            const formUrl = "{{ route('guest.form') }}";
        </script>
        @vite(['resources/assets/js/leads-form.js'])
    @endsection
</section>
