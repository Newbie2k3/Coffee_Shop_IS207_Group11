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
            url: '{{ url("/add-to-cart") }}',
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