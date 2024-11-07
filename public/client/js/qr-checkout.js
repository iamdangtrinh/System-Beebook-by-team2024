(function ($) {
    let DT = {};

    DT.checkStatus = async () => {
        const urlPath = window.location.pathname;
        const id = urlPath.split("/").pop();
        let data = { id };

        let paymentChecked = false; // Biến cờ để theo dõi trạng thái thanh toán

        // Hàm kiểm tra trạng thái thanh toán
        const checkPaymentStatus = async () => {
            try {
                const response = await fetch(`/order-check-status`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                            "content"
                        ),
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();

                if (result.payment_status === "PAID") {
                    if (!paymentChecked) {
                        paymentChecked = true; // Đánh dấu trạng thái đã kiểm tra thanh toán
                        console.log("Đã thanh toán");
                        window.location.href = `/thank-you/${data.id}`;
                    }
                } else {
                    console.log("Chưa thanh toán");
                }
            } catch (error) {
                console.error("Lỗi khi kiểm tra thanh toán:", error);
            }
        };

        // Kiểm tra trạng thái thanh toán mỗi 5 giây
        const intervalId = setInterval(() => {
            if (paymentChecked) {
                clearInterval(intervalId); // Dừng kiểm tra nếu đã thanh toán
            } else {
                checkPaymentStatus();
            }
        }, 5000); // Kiểm tra mỗi 5 giây
    };

    DT.timerCheckout = () => {
        let countdownTime = 5 * 60; // 5 phút = 5 * 60 giây

        // Hàm cập nhật bộ đếm mỗi giây
        function updateCountdown() {
            let minutes = Math.floor(countdownTime / 60);
            let seconds = countdownTime % 60;

            // Thêm số 0 nếu giây < 10 để đảm bảo định dạng 2 chữ số
            seconds = seconds < 10 ? "0" + seconds : seconds;

            // Cập nhật nội dung của thẻ timer
            document
                .getElementById("timer")
                .text(`${minutes} Phút ${seconds} Giây`);

            // Giảm thời gian
            countdownTime--;

            // Khi đếm ngược xong, có thể hiện thông báo hoặc dừng lại
            if (countdownTime < 0) {
                clearInterval(countdownInterval);
                document.getElementById("timer").textContent = "Hết hạn";
            }
        }

        // Cập nhật đếm ngược mỗi giây
        let countdownInterval = setInterval(updateCountdown, 1000);
    };

    $(document).ready(function () {
        DT.checkStatus();
        //   DT.timerCheckout();
    });
})(jQuery);
