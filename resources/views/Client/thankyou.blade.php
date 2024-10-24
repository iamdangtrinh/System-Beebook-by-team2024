<title>@yield('title', 'Giỏ hàng')</title>
@extends('layout.client')

@section('body')
    <style>
        .checkout-scard {
            background: #fff;
            -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, .3);
            box-shadow: 0 0 3px rgba(0, 0, 0, .3);
            margin-bottom: 30px;
        }

        .ship-info-details h3 {
            background-color: #fbfbfb;
            font-size: 15px;
            font-weight: 600;
            padding: 10px 15px;
            margin: -1px 0 15px;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
        }

        .ship-info-details {
            margin: 0 0 20px;
            padding: 0 0 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .ship-info-details p {
            padding: 0 15px;
            margin: 0 0 5px;
        }

        
        .billing-details span,
        .shipping-details span {
            font-weight: 700;
            width: 200px;
            display: inline-block;
        }
    </style>

    <div class="container checkout-success-content py-2 mt-3">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="checkout-scard card border-0 rounded">
                    <div class="card-body text-center">
                        <p class="card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#198754"
                                class="bi bi-shield-fill-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793z" />
                            </svg>

                        </p>
                        <h2 class="card-title">Cảm ơn bạn đã đặt hàng!</h2>
                        <p class="card-text mb-1">Bạn sẽ nhận được email xác nhận đơn hàng với thông tin chi tiết về
                            đặt hàng
                            và một liên kết để theo dõi tiến trình của nó.</p>
                        <p class="card-text mb-1">Tất cả thông tin cần thiết về việc giao hàng, chúng tôi đã gửi đến email
                            của bạn
                        </p>
                        <p class="card-text text-order badge bg-success my-3">Đơn hàng của bạn: <b>{{ $resultBill->id }}</b>
                        </p>
                        <p class="card-text mb-0">Thời gian đặt hàng:
                            {{ date('H:i:s d-m-Y', strtotime($resultBill->created_at)) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="ship-info-details shipping-method-details">
                    <div class="row g-0">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="shipping-details mb-4 mb-sm-0 clearfix">
                                <h3>Địa chỉ giao hàng</h3>
                                <p><span class="__custom_shipping">Họ và tên:</span> {{ $resultBill->name }}</p>
                                <p><span class="__custom_shipping">Địa chỉ email:</span> {{ $resultBill->email }}</p>
                                <p><span class="__custom_shipping">Địa chỉ:</span> {{ $resultBill->address }}</p>
                                <p><span class="__custom_shipping">Số điện thoại:</span> {{ $resultBill->phone }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="billing-details clearfix">
                                <h3>Địa chỉ thanh toán</h3>
                                <p><span class="__custom_shipping">Họ và tên:</span> {{ Auth::user()->name }}</p>
                                <p><span class="__custom_shipping">Địa chỉ email:</span> {{ Auth::user()->email }}</p>
                                <p><span class="__custom_shipping">Địa chỉ:</span> {{ Auth::user()->address }}</p>
                                <p><span class="__custom_shipping">Số điện thoại:</span> {{ Auth::user()->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ship-info-details billing-payment-details">
                    <div class="row g-0">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="shipping-details mb-4 mb-sm-0 clearfix">
                                <h3>Phương thức vận chuyển</h3>
                                <p> <span class="__custom_shipping">Phương thức vận chuyển: </span> {{$resultBill->shipping_method}} </p>
                                <p> <span class="__custom_shipping">Phí vận chuyển: </span> {{$resultBill->fee_shipping}} </p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="billing-details clearfix">
                                <h3>Phương thức thanh toán</h3>
                                <p> <span class="__custom_shipping">Phương thức thanh toán: </span> {{$resultBill->payment_method}}</p>
                                <p> <span class="__custom_shipping">Trạng thái thanh toán: </span> {{$resultBill->payment_status}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex-wrap w-100 mt-4">
                    <a href="{{ route('product.index') }}"
                        class="d-inline-flex align-items-center btn btn-outline-primary rounded me-2 mb-2 me-sm-3"><i
                            class="me-2 icon an an-angle-left-r"></i>Tiếp tục mua hàng</a>
                    <button type="button" class="d-inline-flex align-items-center btn rounded me-2 mb-2 me-sm-3"><i
                            class="me-2 icon an an-print"></i>Tải hoá đơn</button>
                    <button type="button" class="d-inline-flex align-items-center btn rounded me-2 mb-2 me-sm-3"><i
                            class="me-2 icon an an-sync-ar"></i>Mua lại</button>
                </div>
            </div>
        </div>
    </div>
@endsection
