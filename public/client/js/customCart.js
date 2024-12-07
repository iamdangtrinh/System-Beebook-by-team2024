(function ($) {
    let DT = {};

    DT.updateQuantityCart = (e) => {
        let cartQtyInput = $(".cart__qty-input");
        let qtyBtnMinus = $(".qtyBtnMinus");
        let qtyBtnPlus = $(".qtyBtnPlus");

        // giảm số lượng
        qtyBtnMinus.on("click", function (e) {
            e.preventDefault();
            toastr.remove();
            toastr.remove();
            let _this = $(this);
            _this.attr("disabled", true);
            let idProduct = _this
                .closest("tr")
                .find(".inputCheckCart")
                .data("id-product");
            var quantity = _this.siblings(".cart__qty-input").val();
            DT.handlerAjax(quantity, idProduct, _this);
        });

        // tăng số lượng
        qtyBtnPlus.on("click", function (e) {
            e.preventDefault();
            toastr.remove();
            let _this = $(this);
            _this.attr("disabled", true);

            let idProduct = _this
                .closest("tr")
                .find(".inputCheckCart")
                .data("id-product");
            var quantity = _this.siblings(".cart__qty-input").val();

            DT.handlerAjax(quantity, idProduct, _this);
        });

        // thay đổi số lượng
        cartQtyInput.on("change", function (e) {
            e.preventDefault(e);
            toastr.remove();
            let _this = $(this);
            let idProduct = _this
                .closest("tr")
                .find(".inputCheckCart")
                .data("id-product");

            if (
                typeof Number($(this).val()) === "string" &&
                /[a-z]/i.test(Number($(this).val()))
            ) {
                _this.val(1);
                let data = {
                    quantity: 1,
                    id_product: idProduct,
                };

                return $.ajax({
                    type: "post",
                    url: `cart/update`,
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        let priceData = _this
                            .closest("tr")
                            .find(".inputCheckCart")
                            .data("price");
                        let amount = quantity * priceData;
                        _this
                            .closest("tr")
                            .find(".money")
                            .attr("priceTotal", amount);
                        _this
                            .closest("tr")
                            .find(".money")
                            .html(amount.toLocaleString("vi-VN") + " đ");
                    },
                });
            }

            let quantity = Number($(this).val());
            if (typeof quantity === "number" && Number.isFinite(quantity)) {
                DT.handlerAjax(quantity, idProduct, _this);
            } else {
                _this.val(1);
                return toastr.error(`Số lượng sản phẩm phải là số.`);
            }
        });
    };

    // xử lí sau khi click
    DT.handlerAjax = (quantity, idProduct, _this) => {
        let data = {
            quantity: quantity,
            id_product: idProduct,
        };
        let quantityMax = _this
            .closest("tr")
            .find(".inputCheckCart")
            .data("max-quantity");
        // nếu số lượng > số max
        if (quantity > quantityMax) {
            if (_this !== "") {
                _this.attr("disabled", false);
            }
            _this.closest("tr").find(".cart__qty-input").val(quantityMax);
            let data = {
                quantity: quantityMax,
                id_product: idProduct,
            };
            $.ajax({
                type: "post",
                url: `cart/update`,
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    let priceData = _this
                        .closest("tr")
                        .find(".inputCheckCart")
                        .data("price");
                    let amount = quantityMax * priceData;
                    _this
                        .closest("tr")
                        .find(".money")
                        .attr("priceTotal", amount);
                    _this
                        .closest("tr")
                        .find(".money")
                        .html(amount.toLocaleString("vi-VN") + " đ");
                },
            });
            return toastr.error(
                `Rất tiếc, bạn chỉ có thể mua tối đa ${quantityMax} sản phẩm`
            );
        }

        $.ajax({
            type: "post",
            url: `cart/update`,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
            success: function (response) {
                toastr.success(response);
                if (_this !== "") {
                    let priceData = _this
                        .closest("tr")
                        .find(".inputCheckCart")
                        .data("price");
                    let amount = quantity * priceData;

                    _this
                        .closest("tr")
                        .find(".money")
                        .attr("priceTotal", amount);
                    _this
                        .closest("tr")
                        .find(".money")
                        .html(amount.toLocaleString("vi-VN") + " đ");
                }
                DT.updateTotalAmount();
            },
            error: function (response) {
                _this.closest("tr").find(".cart__qty-input").val(quantityMax);
                toastr.error(response.responseJSON.errors.quantity);
            },
            complete: function (response) {
                if (_this !== "") {
                    _this.attr("disabled", false);
                }
            },
        });
    };

    // cập nhật số lượng sản phẩm
    DT.updateTotalAmount = () => {
        jQuery(".inputCheckCart").on("click", DT.updateSubtotal());
    };

    DT.updateSubtotal = () => {
        let subTotal = 0;
        $("input.inputCheckCart:checked").each(function () {
            let price = $(this).closest("tr").find(".money").attr("pricetotal");
            subTotal += Number(price) || 0;
        });

        
        jQuery(".subTotal").html(subTotal.toLocaleString("vi-VN") + " đ");
        let totalAmout = 0;
        totalAmout = subTotal + Number($('#fee-shipping').data('fee-shipping'));
        jQuery(".totalAmout").html(totalAmout.toLocaleString("vi-VN") + " đ");
    };

    // xóa sản phẩm trong giỏ hàng
    DT.removeProductCart = () => {
        $(".removeProduct").click(function (e) {
            e.preventDefault();
            const _this = $(this);

            Swal.fire({
                title: "The Internet?",
                text: "That thing is still around?",
                icon: "question",
            });

            Swal.fire({
                title: "Xác nhận xóa?",
                text: "Xác nhận xóa sản phẩm!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Đồng ý và xóa!",
                cancelButtonText: "Không, hủy!",
            }).then((result) => {
                if (result.isConfirmed) {
                    _this.closest(".cartItem").remove();
                    let id_product = _this
                        .closest(".cartItem")
                        .find(".inputCheckCart")
                        .val();
                    let id_cart = _this
                        .closest(".cartItem")
                        .find(".inputCheckCart")
                        .data("id-cart");

                    let data = {
                        id_product,
                        id_cart,
                    };

                    $.ajax({
                        type: "POST",
                        url: `cart/delete`,
                        data: data,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                                "content"
                            ),
                        },
                    });

                    Swal.fire({
                        title: "Đã xóa!",
                        text: "Sản phẩm của bạn đã bị xóa.",
                        icon: "success",
                    });
                    DT.updateTotalAmount();
                }
            });
        });
    };

    // check box code
    DT.checkAllInput = () => {
        const checkAll = $("#checkAll");
        const inputChecks = $("input.inputCheckCart:checkbox");

        checkAll.on("click", function () {
            const isChecked = this.checked;
            inputChecks.prop("checked", isChecked);
            DT.updateSubtotal();
        });

        inputChecks.on("click", function () {
            const allChecked =
                inputChecks.length === inputChecks.filter(":checked").length;
            checkAll.prop("checked", allChecked);
            DT.updateSubtotal();
        });
    };

    DT.saveCookieProductCart = () => {
        $("#cartCheckout").on("click", function () {
            let productChecked = [];
            $("input.inputCheckCart:checked").each(function () {
                let _this = $(this);
                let val = _this.closest("tr").find(".cart__qty-input").val();
                productChecked.push(`${_this.val()}-${val}`);
            });
            DT.setCookie("productChecked", productChecked, 1);
        });
    };

    // Lấy cookie
    DT.getCookie = (name) => {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        return parts.length === 2 ? parts.pop().split(";").shift() : null;
    };

    // Thiết lập cookie
    DT.setCookie = (cookiename, cookievalue, exdays) => {
        const exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        const c_value = btoa(cookievalue) + `; expires=${exdate.toUTCString()}`;
        document.cookie = `${cookiename}=${c_value}; path=/`;
    };

    $(document).ready(function () {
        DT.updateQuantityCart();
        DT.updateTotalAmount();
        // DT.checkAllInput();
        DT.removeProductCart();
        DT.saveCookieProductCart();
    });
})(jQuery);
