(function ($) {
    "use strict";
    let DT = {};
    const pathname = window.location.pathname;
    const parts = pathname.split("/");
    const orderId = parts[parts.length - 1];

    DT.handlerDownloadInvoice = () => {
        jQuery("#downloadInvoice").click(function () {
            // Hiển thị hiệu ứng loading, nếu cần
            jQuery(this).prepend(loading);

            const element = document.getElementById("invoice");

            const today = new Date();
            const date = `${today.getDate()}-${
                today.getMonth() + 1
            }-${today.getFullYear()}`;
            // Cấu hình cho jsPDF
            const opt = {
                margin: 1,
                filename: `Hóa đơn ${orderId} BeeBook ${date}.pdf`,
                image: { type: "PNG", quality: 1 },
                html2canvas: { scale: 1 },
                jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
            };

            // Chuyển HTML thành PDF
            try {
                html2pdf()
                    .from(element)
                    .set(opt)
                    .save()
                    .then(() => {
                        // Tắt hiệu ứng loading sau khi tải xong
                        jQuery(".removeLoading").remove();
                        toastr.success("Tải hóa đơn thành công!");
                    });
            } catch (error) {
                toastr.error("Tải hóa đơn thất bại!");
                // Hiển thị thông báo lỗi nếu có vấn đề
                alert("Có lỗi xảy ra khi tải hóa đơn. Vui lòng thử lại.");
                console.error("Error downloading invoice:", error);
            }
        });
    };

    DT.updateStatusOrder = () => {
        $("#statusOrder").on("click", function () {
            const _this = $(this);
            $('.removeLoading').remove();
            _this.prop('disabled', true).prepend(loading)
            let typeOrder = _this.attr("type-order");
            
            // cập nhật là hủy đơn hàng
            if (typeOrder === "new") {
                DT.handlerUpdateStatusOrder("cancel");
            }
            // ngược lại thì cho đã nhận được hàng
            else if(typeOrder === 'shipping' ) {
                DT.handlerUpdateStatusOrder("success");
            }
        });
    };

    DT.handlerUpdateStatusOrder = (status) => {
        let data = {
            status,
            id: orderId,
        };
        $.ajax({
            type: "POST",
            url: `/order/update`,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log("Lỗi");
                console.log(error);
            },
            complete: function () {
                console.log("thành công");
            },
        });
    };

    $(document).ready(function () {
        DT.handlerDownloadInvoice();
        DT.updateStatusOrder();
    });
})(jQuery);
