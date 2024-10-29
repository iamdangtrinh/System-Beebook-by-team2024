(function ($) {
    $(document).ready(function () {
        // Wishlist toggle for multiple products
        $('.add-to-wishlist').on('click', function (e) {
            e.preventDefault();
            let $this = $(this);
            let productId = $this.data('product-id');

            // Send AJAX request to add or remove product from wishlist
            $.ajax({
                url: 'toggle-wishlist',
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}' // Add CSRF token if needed
                },
                success: function (response) {
                    // Toggle heart icon based on the response
                    if (response.inWishlist) {
                        $this.find('i').removeClass('anm-heart-l').addClass('anm-heart');
                    } else {
                        $this.find('i').removeClass('anm-heart').addClass('anm-heart-l');
                    }
                }
            });
        });
    });
})(jQuery);
