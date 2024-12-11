(function ($) {
    "use strict";
    let DT = {};
    const pathname = window.location.pathname;
    const parts = pathname.split("/");
    const orderId = parts[parts.length - 1];

    DT.handlerDownloadInvoice = () => {
        jQuery("#downloadInvoice").click(function () {
            // Hiển thị hiệu ứng loading, nếu cần
            // jQuery(this).prepend(loading);

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
                        // jQuery(".removeLoading").remove();
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
        $("#cancelOrder").on("click", function () {
            Swal.fire({
                title: "Hủy đơn hàng",
                text: "Vui lòng xác nhận hủy đơn hàng",
                input: "text",
                inputPlaceholder: "Nhập lý do hủy đơn hàng",
                showCancelButton: true,
                confirmButtonText: "Xác nhận hủy",
                cancelButtonText: "Đóng",
                showLoaderOnConfirm: true,

                inputValue: "Khác",
                inputLabel: "Xác nhận hủy đơn hàng",
                inputPlaceholder: "Nhập lý do hủy đơn hàng",

                preConfirm: (reason_cancel) => {
                    DT.handlerUpdateStatusOrder(
                        orderId,
                        "cancel",
                        reason_cancel
                    );
                },
                allowOutsideClick: () => !Swal.isLoading(),
            });
        });
        
        $("#refundOrder").on("click", function () {
            Swal.fire({
                title: "Yêu cầu hoàn tiền",
                text: "Bạn có chắc chắn hủy và hoàn lại tiền của đơn hàng không?",
                showCancelButton: true,
                confirmButtonText: "Xác nhận hủy và hoàn tiền tiền",
                cancelButtonText: "Đóng",
                showLoaderOnConfirm: true,

                preConfirm: (reason_cancel) => {
                    DT.handlerUpdateStatusOrder(
                        orderId,
                        "cancel",
                        reason_cancel
                    );
                },
                allowOutsideClick: () => !Swal.isLoading(),
            });
        });

        $("#successOrder").on("click", function () {
            Swal.fire({
                title: "Đã nhận đơn hàng",
                text: "Vui lòng xác nhận đã nhận đơn hàng",
                showCancelButton: true,
                confirmButtonText: "Xác nhận",
                cancelButtonText: "Đóng",
                preConfirm: () => {
                    DT.handlerUpdateStatusOrder(orderId, "success");
                },
                allowOutsideClick: () => !Swal.isLoading(),
            });
        });
    };

    DT.handlerUpdateStatusOrder = (orderId, status, reason_cancel = "") => {
        let data = {
            status,
            reason_cancel,
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
                toastr.success(response);
                setTimeout(() => {
                    location.reload();
                }, 1000);
                
            },
            error: function (error) {
                toastr.error(error);
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
