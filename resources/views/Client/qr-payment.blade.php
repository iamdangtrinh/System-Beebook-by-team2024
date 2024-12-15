<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Thanh toán</title>
    <link rel="stylesheet" href="{{ asset('/') }}client/css/bootstrap.min.css">
    <script src="{{ asset('/') }}client/js/jquery.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row my-5 px-2">
            <div class="col-md-8 mx-auto">
                <h1><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                        class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path
                            d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                    </svg> Đặt hàng thành công</h1>
                <span class="text-muted">Mã đơn hàng #DH{{ $order_details->id }}</span>

                <div class="row mt-5" id="checkout_box">
                    <div class="col-md-6">
                        <p class="fw-bold">Cách 1: Mở app ngân hàng và quét mã QR</p>
                        <img src="https://qr.sepay.vn/img?bank=MBBank&acc=0362094527&template=compact&amount={{ intval($order_details->total_amount) }}&des=BEE){{ $order_details->id }}"
                            class="img-fluid">
                        <span>Trạng thái: Chờ thanh toán... <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div></span>
                    </div>
                    <div class="col-md-6">
                        <p class="fw-bold">Cách 2: Chuyển khoản thủ công theo thông tin</p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Ngân hàng:</td>
                                    <td><b>MB Bank</b></td>
                                </tr>
                                <tr>
                                    <td>Chủ tài khoản:</td>
                                    <td><b>Nguyễn Cao Đăng Trình</b></td>
                                </tr>
                                <tr>
                                    <td>Số TK:</td>
                                    <td><b>0362094527</b></td>
                                </tr>
                                <tr>
                                    <td>Số tiền:</td>
                                    <td><b>{{ number_format($order_details->total_amount) }}đ</b></td>
                                </tr>
                                <tr>
                                    <td>Nội dung CK:</td>
                                    <td><b>BEE{{ $order_details->id }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <p class="mt-5"><a class="text-decoration-none" href="{{ route('order.index') }}">Quay lại</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/') }}client/js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}client/js/qr-checkout.js"></script>
</body>

</html>

<style>
    /* Tùy chỉnh giao diện */
    body {
        background-color: #f5f5f5;
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .payment-info-card {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
    }

    .payment-provider-logo {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .payment-provider-logo img {
        /* width: 40px; */
        height: 40px;
    }

    .payment-provider-name {
        font-size: 1.2rem;
        font-weight: bold;
        margin-left: 10px;
    }

    .order-info {
        color: #888;
    }

    .order-info p {
        margin: 0;
    }

    .order-price {
        color: #D32F2F;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .timer {
        background-color: #f5f5f5;
        color: #D32F2F;
        font-size: 1.2rem;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .qr-card {
        background-color: #CE2626;
        color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .qr-card h5 {
        color: #D32F2F;
        font-weight: bold;
    }

    .qr-logo-container img {
        width: 50px;
        height: 50px;
        margin: 0 10px;
    }

    .qr-code {
        margin: 20px 0;
        border: 5px solid #ffffff;
        border-radius: 10px;
        width: 250px;
        height: 250px;
    }

    .bank-logos {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .bank-logos img {
        width: 40px;
        height: 40px;
        border-radius: 5px;
    }

    .__qr_payment {
        width: 250px;
    }
</style>

{{-- <div class="container py-5">
    <div class="row mx-auto justify-content-center">
        <!-- Thông tin đơn hàng -->
        <div class="col-md-4">
            <div class="payment-info-card shadow-sm">
                <div class="payment-provider-logo">
                    <img src="/client/images/logo.webp" alt="Logo BEEBOOK">
                    <span class="payment-provider-name">Bee Book</span>
                </div>
                <div class="order-info mb-2">
                    <p>Mã đơn hàng</p>
                    <p class="fw-semibold">{{ $order_details->id }}</p>
                </div>
                <div class="order-info mb-2">
                    <p>Mô tả</p>
                    <p class="fw-semibold">BEE{{ $order_details->id }}</p>
                </div>
                <div class="order-info mb-4">
                    <p>Số tiền</p>
                    <p class="order-price">10.000đ</p>
                </div>
                <div class="payment-info-card">
                    <div class="text-center mb-3">
                        <p>Đơn hàng sẽ hết hạn sau:</p>
                        <span id="timer" class="timer"></span> <!-- Ban đầu là 5 phút -->
                    </div>
                    <span>Trạng thái: Chờ thanh toán...
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </span>

                    <div>
                        <a href="#" class="text-danger text-decoration-none">Quay về</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- QR Code thanh toán -->
        <div class="col-md-4">
            <div class="qr-card shadow-sm">
                <h5 class="text-light">Quét mã QR để thanh toán</h5>
                <div class="qr-logo-container d-flex justify-content-center">
                </div>

                <img src="https://qr.sepay.vn/img?bank=MBBank&acc=0362094527&template=compact&amount={{ intval($order_details->total_amount) }}&des=BEE){{ $order_details->id }}&DOWNLOAD=false"
                    class="img-fluid __qr_payment">
               
                <p class="mt-2">Sử dụng ứng dụng <span class="fw-semibold">ngân
                        hàng</span> để quét mã</p>
                <a href="#" class="text-light">Gặp khó khăn khi thanh toán? Xem Hướng dẫn</a>
            </div>
            <div class="bank-logos mt-4">
                <!-- Danh sách ngân hàng -->
                <img src="https://img.mservice.com.vn/momo_app_v2/img/EIB.png" alt="Eximbank">
                <img src="https://img.mservice.com.vn/momo_app_v2/img/EIB.png" alt="SaigonBank">
                <img src="https://img.mservice.com.vn/momo_app_v2/img/EIB.png" alt="SCB">
                <img src="https://img.mservice.com.vn/momo_app_v2/img/EIB.png" alt="KienlongBank">
                <!-- Thêm các logo ngân hàng khác tương tự -->
            </div>
        </div>
    </div>
</div> --}}