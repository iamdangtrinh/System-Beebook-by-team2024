{{-- mã giảm giá --}}
{{-- <h5 class="title_coupon">Khuyến mãi</h5>
                        <form action="#" id="formCouponCode" method="post">
                            <div class="form-group">
                                <label for="coupon">Nhập mã phiếu giảm giá của bạn nếu bạn có.</label>
                                <input type="text" id="couponCode" name="coupon">
                            </div>
                            <div class="actionRow">
                                <button type="button" class="btn sendCouponCode btn w-100">Áp dụng</button>
                            </div>
                        </form> --}}

@extends('layout.client')
@section('title', 'Thanh toán')

@livewireStyles
@section('body')
    <style>
        .__name_product_checkout {
            display: inline-block;
            padding-left: 16px;
            flex: 1;
        }

        .item_checkout .box_name {
            display: flex;
        }

        .order-title {
            margin: 0;
            padding: 20px;
            text-align: center;
            color: #fff;
            background: #CE2626;
            font-weight: bold;
            border-radius: 6px 6px 0 0;
        }

        .__custom_image {
            border-radius: 6px;
            width: 110px;
            border: 2px solid #ddd;
        }

        .your-order-payment {
            border-radius: 0 0 6px 6px;
        }

        .checkout {
            border-radius: 6px
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        .select2-container--default .select2-selection--single {
            border: var(--bs-border-width) solid var(--bs-border-color) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px !important;
        }
    </style>

    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Checkout</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->

    <div class="container">
        <div class="row billing-fields">
            {{--  đơn hàng --}}
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                <div class="checkout bg-light-gray padding-20px-all">
                    <form action="{{ route('checkout.store') }}" method="post">
                        @csrf

                        <h2 class="login-title mb-3">Chi tiết đơn hàng</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <span class="d-block">{{ $error }}</span>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <fieldset>
                            <div class="form-group mb-3 col-md-12 col-lg-12 col-xl-12">
                                <label for="name">Họ và tên <span class="text-danger">*</span> </label>
                                <input class="form-control" name="name" value="{{ old('name') ?? Auth::user()->name }}"
                                    id="name" type="text">
                            </div>

                            <div class="row mb-3">
                                <div class="form-group col-md-12 col-lg-6 col-xl-6">
                                    <label for="phone">Số điện thoại <span class="text-danger">*</span> </label>
                                    <input class="form-control" name="phone"
                                        value="{{ old('phone') ?? Auth::user()->phone }}" id="phone" type="text">
                                </div>
                                <div class="form-group col-md-12 col-lg-6 col-xl-6">
                                    <label for="email">Email <span class="text-danger">*</span> </label>
                                    <input class="form-control" name="email"
                                        value="{{ old('email') ?? Auth::user()->email }}" id="email" type="text">
                                </div>
                            </div>
                        </fieldset>

                        {{-- <fieldset>
                            <div class="form-group mb-3 col-md-12 col-lg-12 col-xl-12">
                                <label for="province">Thành phố/Tỉnh <span class="text-danger">*</span> </label>
                                <select class="form-control setupSelect2" name="province" value="" id="province">
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col-md-12 col-lg-6 col-xl-6">
                                    <label for="district">Quận/Huyện <span class="text-danger">*</span> </label>
                                    <select class="form-control setupSelect2" name="district" value="" id="district">
                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-lg-6 col-xl-6">
                                    <label for="ward">Xã/Phường <span class="text-danger">*</span> </label>
                                    <select class="form-control setupSelect2" name="ward" value="" id="ward">
                                    </select>
                                </div>
                            </div>
                        </fieldset> --}}

                        <fieldset>
                            <div class="row mb-3">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <div class="position-relative">
                                        <label for="input-address">Địa chỉ <span class="text-danger">*</span> </label>
                                        <input class="form-control" name="address"
                                            value="{{ old('address') ?? Auth::user()->address }}"
                                            id="input-address-autocomplete" type="text">

                                        <ul id="showListLocation" class="list-group position-absolute w-100">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row mb-3">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <label for="input-company">Ghi chú đơn hàng</label>
                                    <textarea class="form-control resize-both" name="note" rows="3"></textarea>
                                </div>
                            </div>
                        </fieldset>
                </div>
            </div>

            {{-- đơn hàng --}}
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                <input type="hidden" name="shipping_method" value="GHN">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h2 class="order-title">Đơn hàng của bạn</h2>
                    @livewire('coupon')
                    <div class="your-order-payment">
                        <div class="your-order">
                            @php
                                $subTotal = 0;
                            @endphp
                            <ul class="list_order">
                                @foreach ($result as $product)
                                    @php
                                        $subTotal += $product['quantity'] * $product['price'];
                                    @endphp
                                    <li class="item_checkout mb-3 d-flex align-items-start">

                                        @foreach ($product->cartProduct as $cartProduct)
                                            <img class="__custom_image" width="80px"
                                                src="{{ $cartProduct->image_cover }} ? {{ $cartProduct->image_cover }} : '/no_image.jpg' }}"
                                                alt="{{ $product['name'] }}">
                                            
                                        @endforeach

                                        <p class="__name_product_checkout"> <strong> {{ $product['quantity'] }}
                                            </strong> x
                                            <span class="w-75">
                                                @foreach ($product->cartProduct as $cartProduct)
                                                    {{ $cartProduct->name }}
                                                @endforeach
                                            </span>
                                        </p>
                                        <span>{{ number_format($product['quantity'] * $product['price'], '0', '.', '.') }}
                                            đ</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="total">
                            <div class="row border-bottom mb-3">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Tạm tính:</span>
                                <span class="col-12 col-sm-6 text-right"><span data-sub-total="{{ $subTotal }}"
                                        id="subTotal">{{ number_format($subTotal, '0', '.', '.') }} đ</span></span>
                            </div>
                            <div class="row border-bottom mb-3">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Phí vận chuyển:</span>
                                <span class="col-12 col-sm-6 text-right"><span id="freeShipping">
                                        @if ($subTotal < 1000000)
                                            20.000đ
                                            @php
                                                $subTotal += 20000;
                                            @endphp
                                            <input type="hidden" name="fee_shipping" value="20000">
                                        @else
                                            <input type="hidden" name="fee_shipping" value="0">
                                            Miễn phí vận chuyển
                                        @endif
                                    </span></span>
                            </div>
                            <div class="row border-bottom mb-3">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Tổng tiền:</span>
                                <span class="col-12 col-sm-6 text-right"><span id="totalAmout">
                                        {{ number_format($subTotal, '0', '.', '.') }} đ</span></span>
                            </div>
                        </div>

                        <div class="your-payment">
                            <h4 class="payment-title color-black mb-3">Phương thức thanh toán</h4>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion" class="payment-section">
                                        @foreach (config('checkout.payment.paymentCheckout') as $method)
                                            <div class="card mb-2">
                                                <div class="card-header d-flex">
                                                    <input type="radio"
                                                        {{ $method['value'] == 'ONLINE_VALUE' ? 'checked' : '' }}
                                                        id="{{ $method['value'] }}" name="payment_method"
                                                        value="{{ $method['method'] }}" onclick="applyCoupon()">

                                                    <label for="{{ $method['value'] }}" class="mx-2 card-link w-100"
                                                        data-bs-toggle="collapse" href="#{{ $method['method'] }}"
                                                        role="button" aria-expanded="false"
                                                        aria-controls="{{ $method['method'] }}">
                                                        {{ $method['title'] }}
                                                    </label>
                                                </div>

                                                <div id="{{ $method['method'] }}" class="collapse"
                                                    data-bs-parent="#accordion">
                                                    <div class="card-body">
                                                        <p class="no-margin font-15">{{ $method['description'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="order-button-payment">
                                    <button class="btn w-100" value="submit_checkout" name="checkout"
                                        type="submit">Tiến hành thanh
                                        toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!--Scoll Top-->
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    <!--End Scoll Top-->

    <script src="{{ asset('/') }}client/js/customCheckout.js"></script>

    {{-- lo dash --}}
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function applyCoupon() {
            lx
        }
    </script>
    @livewireScripts
@endsection
