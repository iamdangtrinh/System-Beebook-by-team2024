(function ($) {
    let DT = {};

    DT.checkStatus = () => {
        const urlPath = window.location.pathname;
        const id = urlPath.split("/").pop();
        let data = {
            id,
        };
        setInterval(() => {
            $.ajax({
                type: "POST",
                url: `/order-check-status`,
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    console.log(response.payment_status);
                    
                    if (response.payment_status == "PAID") {
                        console.log("Đã thanh toán");
                        window.location.href = `/thank-you/${data.id}`;
                    } else {
                        console.log("Chưa thanh toán");
                    }
                    //   console.log('====================================');
                    //   console.log(response);
                    //   console.log('====================================');
                },
                error: function (error) {
                    console.log("Lỗi");
                    console.log(error);
                },
            });
        }, 1000);
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
        // DT.checkStatus();
        //   DT.timerCheckout();
    });
})(jQuery);
