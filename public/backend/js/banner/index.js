(function ($) {
      let DT = {};
  
      // Hàm mở CKFinder và xử lý khi người dùng chọn ảnh
      DT.uploadImageAvatar = () => {
          $(".file-upload").on("click", function () {
              let input = $(this); // Lấy phần tử chứa file-upload
              DT.browServerAvatar(input); // Gọi hàm để mở CKFinder
          });
      };
  
      // Hàm mở CKFinder và xử lý việc chọn ảnh
      DT.browServerAvatar = (object) => {
          var finder = new CKFinder();
          finder.selectActionFunction = function (fileUrl) {
              // Cập nhật giá trị của input ẩn (lưu URL ảnh vào)
              object.siblings("input.url_image").val(`/${fileUrl}`); // Cập nhật đường dẫn ảnh vào input ẩn
  
              // Hiển thị ảnh preview cho ảnh chính
              object.find("img").attr("src", `/${fileUrl}`); // Cập nhật ảnh preview trong thẻ <img> (id="image-preview")
          };
          finder.popup(); // Mở CKFinder
      };
  
      // Hàm xử lý tải lên nhiều ảnh và hiển thị tại gallery-preview
      DT.uploadGalleryImages = () => {
          $("#gallery-upload").on("click", function () {
              var finder = new CKFinder();
              finder.selectActionFunction = function (fileUrl) {
                  // Lấy URL của hình ảnh và thêm vào gallery preview
                  var galleryItem = '<div class="gallery-item"><img src="/' + fileUrl + '" alt="Gallery Image"><button class="delete-button">Delete</button></div>';
                  $("#gallery-preview").append(galleryItem); // Hiển thị ảnh vào gallery-preview
  
                  // Cập nhật lại giá trị trong input ẩn (lưu mảng các URL ảnh)
                  var currentImages = $(".url_image").val(); // Lấy mảng các URL ảnh hiện tại
                  currentImages = currentImages ? currentImages.split(",") : []; // Nếu có ảnh thì split thành mảng
                  currentImages.push(`/${fileUrl}`); // Thêm ảnh mới vào mảng
                  $(".url_image").val(currentImages.join(",")); // Cập nhật lại giá trị cho input ẩn
              };
              finder.popup(); // Mở CKFinder để chọn ảnh
          });
      };
  
      // Hàm xóa ảnh khỏi preview và mảng input
      $(document).on("click", ".delete-button", function () {
          var imageElement = $(this).closest(".gallery-item");
          var imageUrl = imageElement.find("img").attr("src"); // Lấy URL ảnh
  
          // Xóa phần tử ảnh khỏi preview
          imageElement.remove();
  
          // Cập nhật lại giá trị cho input ẩn, loại bỏ URL đã xóa
          var currentImages = $(".url_image").val().split(",");
          var newImages = currentImages.filter(url => url !== imageUrl);
          $(".url_image").val(newImages.join(","));
      });
  
      $(document).ready(function () {
          DT.uploadImageAvatar(); // Gọi hàm uploadImageAvatar khi trang đã sẵn sàng
          DT.uploadGalleryImages(); // Gọi hàm uploadGalleryImages khi trang đã sẵn sàng
      });
  })(jQuery);
  