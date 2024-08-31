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

            let maxQuantity = _this.siblings('.cart__qty-input').data('quantity-max');
            DT.handlerAjax(
                // số lượng nhập vào
                inputValue,
                // id sản phẩm
                _this.data('id-product'),
                // Nút 
                _this,
                // giá 
                '',
                maxQuantity
            )
            // _this.siblings('.cart__qty-input').val(_this.siblings('.cart__qty-input').data('quantity-max'))
        })

        // tăng số lượng
        qtyBtnPlus.on('click', function (e) {
            e.preventDefault();
            toastr.remove();
            let _this = $(this);
            _this.attr('disabled', true)
            // giá trị input
            var inputValue = _this.siblings('.cart__qty-input').val();
            let maxQuantity = _this.siblings('.cart__qty-input').data('quantity-max');

            DT.handlerAjax(
                // số lượng nhập vào
                inputValue,
                // id sản phẩm
                _this.data('id-product'),
                // Nút 
                _this,
                // giá 
                '',
                maxQuantity
            )
            // let checkMaxQuantity = DT.checkQuanTityMax(_this.siblings('.cart__qty-input').data('quantity-max'), inputValue, _this);
            // // nếu số lượng nhỏ hơn max
            // if (!checkMaxQuantity) {
            //     DT.handlerAjax(inputValue, _this.data('id-product'), _this)
            // }
            // // nếu số lượng nhập > max
            // else {
            //     _this.siblings('.cart__qty-input').val(_this.siblings('.cart__qty-input').data('quantity-max'))
            // }
        })

        // thay đổi số lượng
        cartQtyInput.on('change', function (e) {
            e.preventDefault(e);
            toastr.remove();
            let _this = $(this);

            if (typeof $(this).val() === 'string' && /[a-z]/i.test($(this).val())) {
                _this.val(1)
                let idProduct = _this.data('id-product');

                let data = {
                    quantity: 1,
                    id_product: idProduct,
                }

                return $.ajax({
                    type: "post",
                    url: `cart/update`,
                    data: data,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
                });
            }

            let quantity = $(this).val();
            let id_product = _this.data('id-product')

            DT.handlerAjax(quantity, id_product, _this, _this.data('quantity-max'))
        })
    }

    DT.handlerAjax = (quantity, idProduct, _this = "", quantityMax) => {
        let data = {
            quantity: quantity,
            id_product: idProduct,
        }

        if (quantity > quantityMax) {
            if (_this !== '') {
                _this.attr('disabled', false);
            }
            _this.closest('tr').find('.cart__qty-input').val(quantityMax);
            let data = {
                quantity: quantityMax,
                id_product: idProduct,
            }
            $.ajax({
                type: "post",
                url: `cart/update`,
                data: data,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
            })
            return toastr.error(`Rất tiếc, bạn chỉ có thể mua tối đa ${quantityMax} sản phẩm`)
        }

        $.ajax({
            type: "post",
            url: `cart/update`,
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
            success: function (response) {
                toastr.success(response)
                if (_this !== '') {
                    let priceData = _this.closest('tr').find('.price_product').data('price')
                    _this.closest('tr').find('.money').html(quantity * priceData)
                } else {

                }
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