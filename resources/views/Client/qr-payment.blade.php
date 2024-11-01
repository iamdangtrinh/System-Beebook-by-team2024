<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="{{ asset('/') }}client/css/bootstrap.min.css">
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
                        <img src="https://qr.sepay.vn/img?bank=MBBank&acc=0362094527&template=compact&amount={{ intval($order_details->total_amount) }}&des=BEE {{ $order_details->id }}"
                            class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <p class="fw-bold">Cách 2: Chuyển khoản thủ công theo thông tin</p>
                        <table class="table">
                            <tbody>
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
                                    <td><b>BEE {{ $order_details->id }}</b></td>
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
</body>

</html>
