(function ($) {
    "use strict";
    let DT = {};

    DT.setupSelect2 = () => {
        $(".setupSelect2").each(function () {
            $(this).select2();
        });
    };

    DT.inputAddress = () => {
        $("#input-address-autocomplte").on("change", function () {
            let _this = $(this);
            DT.autoComplteAddressGoongApi(_this.val());
        });
    };

    DT.autoComplteAddressGoongApi = (input) => {
        $.ajax({
            type: "get",
            url: `https://rsapi.goong.io/Place/AutoComplete?api_key=3llMTBYg6lewfO3NctgGOQWkynPkZojFyNm6HBpp&radius=20000&input=${input}`,
            data: "",
            success: function (response) {
                response.predictions.map((item) => {
                    console.log(item.description);
                });
            },
            error: function () {},
            complte: function () {},
        });
    };

    DT.CALCFreeShipping = () => {
        DT.getProvincer();

        $('#province').on('change', function() {
            let _this = $(this);
            if(_this.val() !== '') {
                DT.getDistrict(_this.val())
            }
        })
    };

    // get provincer
    DT.getProvincer = () => {
        $.ajax({
            type: "GET",
            url: `https://online-gateway.ghn.vn/shiip/public-api/master-data/province`,
            headers: {
                token: "ed187595-1fec-11ef-a9c4-9e9a72686e07",
            },
            success: function (response) {
                let html = '';
                response.data.map(item => {
                    html += `<option value="${item.ProvinceID}">${item.ProvinceName}</option>`
                })

                $('#province').append(html);
            },
        });
    };

    DT.getDistrict = (provinceID) => {
        console.log('====================================');
        console.log(provinceID);
        console.log('====================================');
    };

    DT.getWard = () => {};

    DT.totalAmoutCheckout = () => {};

    $(document).ready(function () {
        DT.setupSelect2();
        DT.inputAddress();
        DT.CALCFreeShipping();
        // DT.autoComplteAddressGoongApi();
    });
})(jQuery);
