<!-- Libs cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
    integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- AOS init -->
<script>
    AOS.init();
</script>

<!-- My Scripts -->
{{-- <script src="{{ asset('assets/js/cart.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            const id = $(this).data('id');
            const cart_product_id = $('.cart_product_id_' + id).val();
            const cart_product_name = $('.cart_product_name_' + id).val();
            const cart_product_price = $('.cart_product_price_' + id).val();
            const cart_product_description = $(
                '.cart_product_description_' + id
            ).val();
            const _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ url('/add-to-cart') }}',
                method: 'POST',
                data: {
                    cart_product_id: cart_product_id,
                    cart_product_name: cart_product_name,
                    cart_product_price: cart_product_price,
                    cart_product_description: cart_product_description,
                    _token: _token
                },
                success: function(response) {
                    swal("Thành công", "Thêm sản phẩm thành công.", "success");
                    console.log(response);
                },
                error: function(error) {
                    swal(
                        'Thất bại',
                        'Không thể thêm sản phẩm này vào giỏ hàng.',
                        'error'
                    );
                },
            });
        });
    });
</script>

<!-- Page Scripts -->
@yield('page-script')
