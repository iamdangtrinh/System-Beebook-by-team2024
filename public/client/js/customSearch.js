(function ($) {
    $(document).ready(function () {
        // Bắt sự kiện nhập liệu vào ô tìm kiếm
        $('#search').on('keyup', function () {
            let query = $(this).val().trim(); // Loại bỏ khoảng trắng thừa

            if (query.length > 0) { // Chỉ thực hiện tìm kiếm nếu có ít nhất 2 ký tự
                // Gửi yêu cầu AJAX
                $.ajax({
                    url: `/search/ajax`,
                    method: 'GET',
                    data: { query: query },
                    success: function (response) {
                        let resultsHTML = '';

                        // Hiển thị sách
                        if (response.books && response.books.length > 0) {
                            resultsHTML += '<div class="col-12"><strong>Sách</strong></div>';
                            response.books.forEach(book => {
                                resultsHTML += `
                                    <div class="search-item col-md-6 col-sm-12 my-3">
                                        <a href="/san-pham/${book.slug}" class="d-flex">
                                            <img width="50px" src="${book.image_cover || '/no_image.jpg'}" alt="${book.name}">
                                            <p class="ms-2 text-clamp">${book.name}</p>
                                        </a>
                                    </div>
                                `;
                            });
                        }

                        // Hiển thị tác giả
                        if (response.authors && response.authors.length > 0) {
                            resultsHTML += '<div class="col-12"><strong>Tác giả</strong></div>';
                            response.authors.forEach(author => {
                                resultsHTML += `<div class="col-md-6 col-sm-12"><a href="/tac-gia/${author.slug}">${author.name}</a></div>`;
                            });
                        }

                        // Hiển thị nhà xuất bản
                        if (response.publishers && response.publishers.length > 0) {
                            resultsHTML += '<div class="col-12"><strong>Nhà xuất bản</strong></div>';
                            response.publishers.forEach(publisher => {
                                resultsHTML += `<div class="col-md-6 col-sm-12"><a class="my-1 px-1 border border-secondary rounded-pill text-truncate" href="/nha-xuat-ban/${publisher.slug}">${publisher.name}</a></div>`;
                            });
                        }

                        // Đổ kết quả tìm kiếm vào container
                        if (resultsHTML) {
                            $('#search-results').html(resultsHTML).show();
                        } else {
                            $('#search-results').html('<p>Không tìm thấy kết quả.</p>').show();
                        }
                    },
                    error: function () {
                        $('#search-results').html('<p>Không tìm thấy kết quả.</p>').show();
                    }
                });
            } else {
                // Ẩn kết quả tìm kiếm nếu chuỗi ngắn
                $('#search-results').html('').hide();
            }
        });

        // Ẩn kết quả khi nhấn ngoài vùng tìm kiếm
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#search, #search-results').length) {
                $('#search-results').hide();
            }
        });
    });
})(jQuery);
