(function ($) {
    $(document).ready(function () {
        $('.add-to-wishlist').on('click', function (e) {
            e.preventDefault();
            let $this = $(this);
            let idproduct = $this.data('product-id');

            // Gửi yêu cầu AJAX để thêm hoặc xóa sản phẩm khỏi yêu thích
            $.ajax({
                url: `/wishlist/toggle/${idproduct}`,
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
                },
                success: function (response) {
                    // Thay đổi icon dựa vào trạng thái yêu thích
                    if (response.status === 'added') {
                        $this.find('i').removeClass('anm-heart-l').addClass('anm-heart text-danger');
                        $this.find('span').text('Đã thêm sản phẩm vào yêu thích');
                    } else {
                        $this.find('i').removeClass('anm-heart text-danger').addClass('anm-heart-l');
                        $this.find('span').text('Thêm vào yêu thích');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                    console.log("Status:", status);
                    console.log("Response Text:", xhr.responseText);
                }
            });
        });
    });
})(jQuery);
