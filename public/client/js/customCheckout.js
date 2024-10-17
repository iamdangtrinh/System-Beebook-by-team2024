(function ($) {
    "use strict";
    let DT = {};

    DT.setupSelect2 = () => {
        $(".setupSelect2").each(function () {
            $(this).select2();
        });
    };

    DT.setupSelect2Tag = () => {
        $(".setupSelect2").each(function () {
            $(this).select2({
                tags: true,
            });
        });
    };

    DT.inputAddress = () => {
        $("#input-address-autocomplete").on("input", function () {
            let _this = $(this);
            console.log(_this.val());

            const getLocation = _.debounce(
                () => DT.autoCompleteAddressGoongApi(_this.val()),
                1000
            );
            getLocation();
        });
    };

    DT.autoCompleteAddressGoongApi = (input) => {
        $.ajax({
            type: "get",
            url: `https://rsapi.goong.io/Place/AutoComplete?api_key=3llMTBYg6lewfO3NctgGOQWkynPkZojFyNm6HBpp&more_compound=true&radius=20000&input=${input}`,
            data: "",
            success: function (response) {
                console.log(response);
                let html = "";
                response.predictions.map((item) => {
                    html += `<li class="list-group-item cursor-pointer" data-value="${item.description}">${item.description}</li>`;
                });
                $("#showListLocation").html(html);

                $(".list-group-item").on("click", function (e) {
                    const _this = $(this);
                    $('#input-address-autocomplete').val(_this.data('value'));
                    $('.list-group-item').remove()
                });
            },
            error: function () {},
            complte: function () {},
        });
    };

    DT.CALCFreeShipping = () => {
        DT.getProvincer();

        $("#province").on("change", function () {
            let _this = $(this);
            if (_this.val() !== "") {
                DT.getDistrict(_this.val());
            }
        });
    };

    // get provincer
    DT.getProvincer = () => {
        $.ajax({
            type: "GET",
            url: `provincer`,
            success: function (response) {
                let html = "";
                response.data.map((item) => {
                    html += `<option value="${item.ProvinceID}">${item.ProvinceName}</option>`;
                });

                $("#province").append(html);
            },
        });
    };

    DT.getDistrict = (provinceID) => {
        $.ajax({
            type: "GET",
            url: `district/${provinceID}`,
            success: function (response) {
                let html = "";
                response.data.map((item) => {
                    html += `<option value="${item.DistrictID}">${item.DistrictName}</option>`;
                });

                $("#district").html(html);
                $("#district").on("change", function () {
                    let _this = $(this);
                    if (_this.val() !== "") {
                        DT.getWard(_this.val());
                    }
                });
            },
        });
    };

    DT.getWard = (districtID) => {
        $.ajax({
            type: "GET",
            url: `ward/${districtID}`,
            success: function (response) {
                let html = "";
                response.data.map((item) => {
                    html += `<option value="${item.WardCode}">${item.WardName}</option>`;
                });

                $("#ward").html(html);
            },
        });
    };

    DT.totalAmoutCheckout = () => {};

    $(document).ready(function () {
        DT.setupSelect2();
        // DT.setupSelect2Tag();
        DT.inputAddress();
        DT.CALCFreeShipping();
        // DT.autoCompleteAddressGoongApi();
    });
})(jQuery);
