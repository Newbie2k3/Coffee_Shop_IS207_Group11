<x-guest-layout>
    @section('page-script')
        <script src="{{ asset('assets/js/cart.js') }}"></script>
    @endsection

    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Cố lên , 1 bước nữa là bạn cống tiền cho chúng tôi rồi haha</h5>
                        </div>
                        <div class="card-body p-4">
                            @foreach ($cart_items as $cart_item)
                                <div class="card shadow-0 border mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/1.webp"
                                                    class="img-fluid" alt="Phone">
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">{{ $cart_item->product->name }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">
                                                    {{ $cart_item->product->category->name }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">{{ $cart_item->product->price }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">Số lượng: {{ $cart_item->quantity }}
                                                </p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">
                                                    {{ $cart_item->product->price * $cart_item->quantity }}</p>
                                            </div>
                                        </div>
                                        <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between pt-2">
                                <p class="fw-bold mb-0">Tổng</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> {{ $cart_total }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <form class="form-control" id="createOrderForm">

                                <select id="paymentMethodSelect">
                                    <option selected disabled>-- Chọn phương thức --</option>
                                    @foreach ($liststatus as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="payment_method_id" id="payment_method_id">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Thanh toán</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
