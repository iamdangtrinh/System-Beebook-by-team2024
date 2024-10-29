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

    $(document).ready(function () {
        DT.uploadImageAvatar();
        CKEDITOR.replace('content');
    });
})(jQuery);
