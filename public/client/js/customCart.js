(function ($) {

    let DT = {};

    DT.updateQuantityCart = (e) => {
        let cartQtyInput = $('.cart__qty-input');
        let qtyBtnMinus = $('.qtyBtnMinus');
        let qtyBtnPlus = $('.qtyBtnPlus');

        qtyBtnMinus.on('click', function (e) {
            e.preventDefault();
            let _this = $(this);
            var inputValue = _this.siblings('.cart__qty-input').val();
            console.log(inputValue);
        })
        
        qtyBtnPlus.on('click', function (e) {
            e.preventDefault();
            let _this = $(this);
            var inputValue = _this.siblings('.cart__qty-input').val();
            console.log(inputValue);
        })
    }

    DT.handlerAjax = (quantity, idProduct, idUser) => {
        console.log();
        
    }

    $.ajax({
        type: "method",
        url: "url",
        data: "data",
        dataType: "dataType",
        success: function (response) {
            
        }
    });

    $(document).ready(function () {
        DT.updateQuantityCart();
    });


})(jQuery)