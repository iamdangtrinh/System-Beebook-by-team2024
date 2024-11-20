(function ($) {
    let DT = {};

    DT.uploadImageAvatar = () => {
        $(".file-upload").on("click", function () {
            let input = $(this);
            DT.browServerAvatar(input);
        });
    };

    DT.browServerAvatar = (object) => {
        var finder = new CKFinder();
        finder.selectActionFunction = function (fileUrl) {
            object.siblings("input.url_image").val(`/${fileUrl}`);
            object.find("img").attr("src", `/${fileUrl}`);
        };
        finder.popup();
    };

    DT.uploadGalleryImages = () => {
        $("#gallery-upload").on("click", function () {
            var finder = new CKFinder();
            finder.selectActionFunction = function (fileUrl) {
                var galleryItem =
                    '<div class="gallery-item"><img src="/' +
                    fileUrl +
                    '" alt="Gallery Image"><button class="delete-button">Xóa</button></div>';
                $("#gallery-preview").append(galleryItem);
                var currentImages = $(".url_image").val();
                currentImages = currentImages ? currentImages.split(",") : [];
                currentImages.push(`/${fileUrl}`);
                $(".url_image").val(currentImages.join(","));
            };
            finder.popup();
        });
    };

    $(document).on("click", ".delete-button", function () {
        var imageElement = $(this).closest(".gallery-item");
        var imageUrl = imageElement.find("img").attr("src");
        imageElement.remove();
        var currentImages = $(".url_image").val().split(",");
        var newImages = currentImages.filter((url) => url !== imageUrl);
        $(".url_image").val(newImages.join(","));
    });

    DT.configSelect2 = () => {
        $(".setupSelect2").each(function (indexInArray, valueOfElement) {
            $(this).select2();
        });
    };

    $(document).ready(function () {
        DT.uploadImageAvatar();
        DT.uploadGalleryImages();
        DT.configSelect2();
    });
})(jQuery);
