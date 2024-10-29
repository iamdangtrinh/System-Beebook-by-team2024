(function ($) {
    let QN = {};

    // Hàm lọc sản phẩm
    QN.filterProducts = () => {
        // Thu thập giá trị của bộ lọc
        let priceRanges = [];
        let languages = [];
        let sortValue = $('#SortBy').val(); // Lấy giá trị sắp xếp

        // Lấy khoảng giá từ các checkbox đã chọn
        $('input[type="checkbox"][name="price"]:checked').each(function () {
            let value = $(this).val();
            if (value.includes('-')) {
                let [min, max] = value.split('-').map(v => parseInt(v.trim().replace(' đ', '').replace(',', '')));
                priceRanges.push({ min, max });
            } else if (value.includes('Trở lên')) {
                priceRanges.push({ min: 700000 });
            }
        });

        // Lấy ngôn ngữ từ các checkbox đã chọn
        $('input[type="checkbox"][name="language"]:checked').each(function () {
            languages.push($(this).val());
        });

        // Gửi yêu cầu Ajax
        $.ajax({
            url: "filter-products",
            method: "GET",
            data: {
                price_min: priceRanges.length > 0 ? Math.min(...priceRanges.map(p => p.min)) : null,
                price_max: priceRanges.length > 0 ? Math.max(...priceRanges.map(p => p.max || 700000)) : null,
                languages: languages,
                sort: sortValue // Thêm giá trị sắp xếp vào dữ liệu gửi đi
            },
            success: function (data) {
                $('#product-list').html(data); // Hiển thị sản phẩm đã lọc
            }
        });
    };

    // Sự kiện khi chọn checkbox hoặc thay đổi sắp xếp
    $(document).ready(function () {
        $('input[type="checkbox"]').on('change', function () {
            QN.filterProducts();
        });

        $('#SortBy').on('change', function () { // Bắt sự kiện khi thay đổi sắp xếp
            QN.filterProducts();
        });
    });
})(jQuery);
