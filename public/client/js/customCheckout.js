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
        const $input = $("#input-address-autocomplete");
        const $showListLocation = $("#showListLocation");

        $input.on("input", function () {
            let _this = $(this);
            const getLocation = _.debounce(
                () => DT.autoCompleteAddressGoongApi(_this.val()),
                700
            );
            getLocation();
        });
        $input.on("blur", function () {
            setTimeout(() => $showListLocation.find('.list-group-item').remove(), 100);
        });

        $showListLocation.on("mousedown", function (e) {
            e.preventDefault();
        });
    };

    DT.autoCompleteAddressGoongApi = (input) => {
        $.ajax({
            type: "get",
            url: `https://rsapi.goong.io/Place/AutoComplete?api_key=3llMTBYg6lewfO3NctgGOQWkynPkZojFyNm6HBpp&more_compound=true&radius=20000&input=${input}`,
            data: "",
            success: function (response) {
                let html = "";
                response.predictions.map((item) => {
                    html += `<li class="list-group-item cursor-pointer" data-value="${item.description}">${item.description}</li>`;
                });
                $("#showListLocation").html(html);

                $(".list-group-item").on("click", function (e) {
                    const _this = $(this);
                    $("#input-address-autocomplete").val(_this.data("value"));
                    $(".list-group-item").remove();
                });
            },
            error: function () {},
            complte: function () {},
        });
    };

    DT.totalAmoutCheckout = () => {};

    $(document).ready(function () {
        DT.setupSelect2();
        DT.inputAddress();
    });
})(jQuery);
