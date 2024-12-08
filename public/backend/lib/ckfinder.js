(function ($) {
    "use strict";
    var DT = {};
    DT.uploadImageAvatar = () => {
        $(".image-target").click(function () {
            let input = $(this);
            DT.browServerAvatar(input, "Images");
        });
    };

    DT.browServerAvatar = (object, type) => {
        if (typeof type == "undefined") {
            type = "Images";
        }
        var finder = new CKFinder();
        finder.selectActionFunction = function (fileUrl, data) {
            object.find("img").attr("src", "/" + fileUrl);
            object.siblings("input").val("/" + fileUrl);
        };

        finder.popup();
    };

    DT.configSelect2 = () => {
        $(".setupSelect2").each(function () {
            $(this).select2({});
        });

        $(".setupSelect2HasTag").each(function () {
            $(this).select2({
                tags: true,
            });
        });
    };

    $(document).ready(function () {
        DT.uploadImageAvatar();
        DT.configSelect2();
        CKEDITOR.replace("content", {
            height: 500,
            language: "vi",
        });
    });
})(jQuery);
