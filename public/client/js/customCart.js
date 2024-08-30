(function ($) {

    let DT = {};

    DT.updateQuantityCart = (e) => {
        let cartQtyInput = $('.cart__qty-input');
        let qtyBtnMinus = $('.qtyBtnMinus');
        let qtyBtnPlus = $('.qtyBtnPlus');

        // giảm số lượng
        qtyBtnMinus.on('click', function (e) {
            e.preventDefault();
            toastr.remove();
            let _this = $(this);
            _this.attr('disabled', true)
            var inputValue = _this.siblings('.cart__qty-input').val();
            let checkMaxQuantity = DT.checkQuanTityMax(_this.siblings('.cart__qty-input').data('quantity-max'), inputValue);
            // nếu số lượng nhỏ hơn max
            if (!checkMaxQuantity) {
                DT.handlerAjax(inputValue, _this.data('id-product'), _this)
            }
            // nếu số lượng nhỏ hơn max
            else {
                _this.siblings('.cart__qty-input').val(_this.siblings('.cart__qty-input').data('quantity-max'))
            }
        })

        // tăng số lượng
        qtyBtnPlus.on('click', function (e) {
            e.preventDefault();
            toastr.remove();
            let _this = $(this);
            _this.attr('disabled', true)
            // giá trị input
            var inputValue = _this.siblings('.cart__qty-input').val();
            let checkMaxQuantity = DT.checkQuanTityMax(_this.siblings('.cart__qty-input').data('quantity-max'), inputValue, _this);
            // nếu số lượng nhỏ hơn max
            if (!checkMaxQuantity) {
                DT.handlerAjax(inputValue, _this.data('id-product'), _this)
            }
            // nếu số lượng nhập > max
            else {
                _this.siblings('.cart__qty-input').val(_this.siblings('.cart__qty-input').data('quantity-max'))
            }
        })

        // thay đổi số lượng
        cartQtyInput.on('change', function (e) {
            e.preventDefault();
            toastr.remove();
            let _this = $(this);

            if (typeof $(this).val() === 'string' && /[a-z]/i.test($(this).val())) {
                return _this.val(1);
            }

            let checkMaxQuantity = DT.checkQuanTityMax(_this.data('quantity-max'), $(this).val());
            if (!checkMaxQuantity) {
                DT.handlerAjax($(this).val(), _this.data('id-product'))
            } else {
                _this.val(_this.data('quantity-max'))
            }
        })
    }

    DT.checkQuanTityMax = (quantityMax, quantity, button = '') => {
        if (quantity > quantityMax) {
            if (button !== '') {
                button.attr('disabled', false);
            }
            return toastr.error(`Rất tiếc, bạn chỉ có thể mua tối đa ${quantityMax} sản phẩm`)
        }

    }

    DT.handlerAjax = (quantity, idProduct, _this = "") => {
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
                toastr.error(response.responseJSON.errors.quantity)
                console.log(response);
            },
            complete: function (response) {
                if (_this !== '') {
                    _this.attr('disabled', false)
                }
            }
        });
    }

    $(document).ready(function () {
        DT.updateQuantityCart();
    });


})(jQuery)