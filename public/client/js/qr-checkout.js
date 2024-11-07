(function ($) {
    let DT = {};

    DT.checkStatus = async () => {
        const id = window.location.pathname.split("/").pop();
        const data = { id };
        const csrfToken = $('meta[name="csrf_token"]').attr("content");

        let isPaid = false; // Track if payment is confirmed to avoid redundant requests

        const checkOrderStatus = async () => {
            if (isPaid) return; // Skip checking if payment is already confirmed

            try {
                const response = await $.ajax({
                    type: "POST",
                    url: `/order-check-status`,
                    data: data,
                    headers: { "X-CSRF-TOKEN": csrfToken },
                });

                if (response === "PAID") {
                    console.log("Đã thanh toán");
                    window.location.href = `/thank-you/${data.id}`;
                    isPaid = true; // Set flag to avoid further checks
                } else {
                    console.log("Chưa thanh toán");
                }
            } catch (error) {
                console.log("Lỗi");
                console.log(error);
            }
        };

        // Check status every 5 seconds, but stop after the payment is confirmed
        const intervalId = setInterval(() => {
            checkOrderStatus();
            if (isPaid) clearInterval(intervalId); // Stop interval once paid
        }, 5000);
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
