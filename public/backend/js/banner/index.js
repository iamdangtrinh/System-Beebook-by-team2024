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
            // object.siblings("input.url_image").val(`/${fileUrl}`);
            // object.find("img").attr("src", `/${fileUrl}`);
            $("#gallery-preview").empty();
            var galleryItem =
                '<div class="gallery-item"><img src="/' +
                fileUrl +
                '" alt="Gallery Image"><button class="delete-button">Xóa</button></div>';
            $("#gallery-preview").append(galleryItem);
            $(".url_image").val(`/${fileUrl}`);
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

    DT.showAler = () => {
        $("._deleteBanner").on("click", function (e) {
            e.preventDefault();
            const href = $(this).attr("href");

            Swal.fire({
                title: "Xác nhận xóa?",
                text: "Bạn có muốn xác nhận xóa hình ảnh này không!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Đóng",
                confirmButtonText: "Chắc chắn!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    };

    // DT.switchess = () => {
    //     // var elem = $("input.js-switch");
    //     // elem.each(function (index, element) {
    //     //     new Switchery(element, { color: "#1AB394" });
    //     // });

    //     $("input.js-switch").on("click", function () {
    //         const _this = $(this);

    //         let data = {
    //             id: _this.attr("data-id"),
    //             status: _this.prop("checked") ? "active" : "inactive",
    //         };

    //         $.ajax({
    //             type: "POST",
    //             url: "/admin/banner/update/status",
    //             data: data,
    //             headers: {"X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),},
    //             success: function (response) {
    //                 console.log(response);
    //             },
    //             error: function (response) {
    //                 console.log("Lỗi");
    //                 console.log(response);
    //             },
    //         });
    //     });
    // };

    DT.updateStatus = () => {
        // Initialize Switchery elements
        const initializeSwitchery = () => {
            $("input.js-switch").each(function () {
                new Switchery(this, { color: "#1AB394" });
            });
        };

        // Handle status update
        const handleStatusUpdate = (event) => {
            const $switch = $(event.target);
            const data = {
                id: $switch.data("id"), // Shortened syntax for attr("data-id")
                status: $switch.prop("checked") ? "active" : "inactive",
            };

            $.ajax({
                type: "POST",
                url: "/admin/banner/update/status",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                        "content"
                    ),
                },
                success: (response) => {
                    toastr.success(response.message);
                },
                error: (error) => {
                    toastr.error(error.responseJSON.error);
                },
            });
        };

        // Initialize functionality
        const init = () => {
            initializeSwitchery();
            $("input.js-switch").on("change", handleStatusUpdate);
        };

        // Execute initialization
        init();
    };

    $(document).ready(function () {
        DT.uploadImageAvatar();
        DT.uploadGalleryImages();
        DT.configSelect2();
        DT.showAler();
        // DT.switchess();
        DT.updateStatus();
    });
})(jQuery);
