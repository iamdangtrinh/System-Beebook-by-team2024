(function ($) {

    let DT = {};

    DT.updateQuantityCart = (e) => {
        let cartQtyInput = $('.cart__qty-input');
        let qtyBtnMinus = $('.qtyBtnMinus');
        let qtyBtnPlus = $('.qtyBtnPlus');

        qtyBtnMinus.on('click', function (e) {
            e.preventDefault();
            let _this = $(this);
            _this.attr('disabled', true)
            var inputValue = _this.siblings('.cart__qty-input').val();
            DT.handlerAjax(inputValue, _this.data('id-product'), _this)

        })

        qtyBtnPlus.on('click', function (e) {
            e.preventDefault();
            let _this = $(this);
            _this.attr('disabled', true)
            var inputValue = _this.siblings('.cart__qty-input').val();
            DT.handlerAjax(inputValue, _this.data('id-product'),_this)
        })
    }

    DT.handlerAjax = (quantity, idProduct, _this) => {

        let data = {
            quantity: quantity,
            id_product: idProduct,
        }

        $.ajax({
            type: "post",
            url: `cart/update`,
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
            success: function (response) {
                toastr.success(response)
            },
            error: function (response) {
                toastr.error(response)
                console.log(response);
            },
            complete: function(response) {
                _this.attr('disabled', false)
            }
        });
    }

    $(document).ready(function () {
        DT.updateQuantityCart();
    });


})(jQuery)