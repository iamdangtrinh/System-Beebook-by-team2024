(function ($) {
    let DT = {};

    // Hàm mở CKFinder và chọn ảnh chính
    DT.uploadMainImage = () => {
        $("#main-image").on("click", function () {
            var finder = new CKFinder();
            finder.selectActionFunction = function (fileUrl) {
                // Cập nhật ảnh chính
                $("#main-image").attr("src", `/${fileUrl}`);
                // Hiển thị nút xóa
                $("#delete-main-image").show();
                // Cập nhật giá trị của input hidden
                $("#main-image-hidden").val(`/${fileUrl}`);
            };
            finder.popup(); // Mở CKFinder
        });
    };

    // Hàm xử lý khi nhấn nút xóa ảnh chính
    DT.deleteMainImage = () => {
        $("#delete-main-image").on("click", function () {
            // Cập nhật ảnh về mặc định
            $("#main-image").attr("src", "/no_image.jpg");
            // Ẩn nút xóa
            $(this).hide();
            // Xóa giá trị trong input hidden
            $("#main-image-hidden").val("");
        });
    };

    // Hàm mở CKFinder và xử lý tải lên nhiều ảnh
    DT.uploadGalleryImages = () => {
        $("#gallery-upload").on("click", function () {
            // Kiểm tra số lượng ảnh hiện tại
            var currentImageCount = $("#gallery-preview .gallery-item").length;
            if (currentImageCount >= 8) {
                toastr.error("Bạn chỉ được tải lên tối đa 8 ảnh."); // Hiển thị thông báo
                return; // Dừng hàm nếu đã đạt giới hạn
            }

            var finder = new CKFinder();
            finder.selectActionFunction = function (fileUrl) {
                // Lấy URL của hình ảnh và thêm vào gallery preview cùng với input hidden
                var totalImages = $("#gallery-preview .gallery-item").length + 1; // Đếm số lượng ảnh hiện tại
                var galleryItem = `
                <div class="gallery-item">
                    <img src="/${fileUrl}" alt="Gallery Image">
                    <button class="delete-button">Xóa ảnh</button>
                    <input type="hidden" name="hinh${totalImages}" class="hidden-input" value="/${fileUrl}">
                </div>`;
                $("#gallery-preview").append(galleryItem); // Thêm ảnh và input hidden vào gallery-preview
            };
            finder.popup(); // Mở CKFinder để chọn ảnh
        });
    };

    // Hàm cập nhật lại tên của các input hidden
    DT.updateHiddenInputNames = () => {
        $("#gallery-preview .hidden-input").each(function (index) {
            $(this).attr("name", `hinh${index + 1}`); // Gán lại tên theo thứ tự
        });
    };

    // Hàm xóa ảnh khỏi preview và cập nhật input hidden
    $(document).on("click", ".delete-button", function () {
        var galleryItem = $(this).closest(".gallery-item");

        // Xóa phần tử ảnh khỏi preview
        galleryItem.remove();

        // Cập nhật lại tên các input hidden
        DT.updateHiddenInputNames();
    });

    $(document).ready(function () {
        DT.uploadMainImage(); // Gọi hàm xử lý chọn ảnh
        DT.deleteMainImage(); // Gọi hàm xử lý xóa ảnh
        DT.uploadGalleryImages(); // Gọi hàm uploadGalleryImages khi trang đã sẵn sàng
    });
})(jQuery);
