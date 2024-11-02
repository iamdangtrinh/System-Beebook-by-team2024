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
                    console.log(response);
                },
                error: function (error) {
                    console.log("Lỗi");
                    console.log(error);
                },
            });
        }, 1000);
    };

    $(document).ready(function () {
        DT.checkStatus();
    });
})(jQuery);
