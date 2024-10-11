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
            success: function (response) {
                  response.predictions.map((item) => {
                        console.log(item.description);
                  })

            },
            error: function () {},
            complte: function () {},
        });
    };

    DT.totalAmoutCheckout = () => {
      
    }

    $(document).ready(function () {
        DT.setupSelect2();
        DT.inputAddress();
        //   DT.autoComplteAddressGoongApi();
    });
})(jQuery);
