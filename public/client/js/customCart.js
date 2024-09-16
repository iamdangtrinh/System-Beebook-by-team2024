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
            toastr.remove();
            let _this = $(this);
            _this.attr('disabled', true)
            let idProduct = _this.closest('tr').find('.inputCheckCart').data('id-product');
            var quantity = _this.siblings('.cart__qty-input').val();
            DT.handlerAjax(quantity, idProduct, _this)
        })

        // tăng số lượng
        qtyBtnPlus.on('click', function (e) {
            e.preventDefault();
            toastr.remove();
            let _this = $(this);
            _this.attr('disabled', true)

            let idProduct = _this.closest('tr').find('.inputCheckCart').data('id-product');
            var quantity = _this.siblings('.cart__qty-input').val();

            DT.handlerAjax(quantity, idProduct, _this)
        })

        // thay đổi số lượng
        cartQtyInput.on('change', function (e) {
            e.preventDefault(e);
            toastr.remove();
            let _this = $(this);
            let idProduct = _this.closest('tr').find('.inputCheckCart').data('id-product');

            if (typeof Number($(this).val()) === 'string' && /[a-z]/i.test(Number($(this).val()))) {
                _this.val(1)
                let data = {
                    quantity: 1,
                    id_product: idProduct,
                }

                return $.ajax({
                    type: "post",
                    url: `cart/update`,
                    data: data,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
                    success: function (response) {
                        let priceData = _this.closest('tr').find('.inputCheckCart').data('price');
                        let amount = quantity * priceData;
                        _this.closest('tr').find('.money').attr('priceTotal', amount);
                        _this.closest('tr').find('.money').html(amount.toLocaleString('vi-VN') + ' đ')
                    }
                },
                );
            }

            let quantity = Number($(this).val());
            if (typeof quantity === 'number' && Number.isFinite(quantity)) {
                DT.handlerAjax(quantity, idProduct, _this);
            } else {
                _this.val(1)
                return toastr.error(`Số lượng sản phẩm phải là số.`)
            }

        })
    }

    // xử lí sau khi click
    DT.handlerAjax = (quantity, idProduct, _this) => {
        let data = {
            quantity: quantity,
            id_product: idProduct,
        }
        let quantityMax = _this.closest('tr').find('.inputCheckCart').data('max-quantity');
        // nếu số lượng > số max
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
                success: function (response) {
                    let priceData = _this.closest('tr').find('.inputCheckCart').data('price');
                    let amount = quantityMax * priceData;
                    _this.closest('tr').find('.money').attr('priceTotal', amount);
                    _this.closest('tr').find('.money').html(amount.toLocaleString('vi-VN') + ' đ')
                }
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
                    let priceData = _this.closest('tr').find('.inputCheckCart').data('price');
                    let amount = quantity * priceData;

                    _this.closest('tr').find('.money').attr('priceTotal', amount);
                    _this.closest('tr').find('.money').html(amount.toLocaleString('vi-VN') + ' đ')
                }
                DT.updateTotalAmount();
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

    DT.updateTotalAmount = () => {
        const updateSubtotal = () => {
            let subTotal = 0;
            $('input.inputCheckCart:checked').each(function () {
                let price = $(this).closest('tr').find('.money').attr('pricetotal');
                subTotal += Number(price) || 0;
            });
            jQuery('.subTotal').html(subTotal.toLocaleString('vi-VN') + ' đ');
        };
        jQuery('.inputCheckCart').on('click', updateSubtotal);
        updateSubtotal();
    };

    // refactor code
    DT.checkAllInput = () => {
        // click vào check all => checked toàn bộ
        $("#checkAll").click(function () {
            // true or false
            const isChecked = this.checked;
            $('input.inputCheckCart:checkbox').prop('checked', isChecked);
            DT.updateTotalAmount();
        });

        // click từng item nếu item == maxItem => checked checkAll
        $('input.inputCheckCart').on('click', function () {
            const allChecked = $('input.inputCheckCart:checkbox').length === $('input.inputCheckCart:checkbox:checked').length;
            $("#checkAll").prop('checked', allChecked);
        });
    }

    $(document).ready(function () {
        DT.updateQuantityCart();
        DT.updateTotalAmount();
        DT.checkAllInput();
    });


})(jQuery)