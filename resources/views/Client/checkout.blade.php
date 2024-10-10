<title>@yield('title', 'Thanh toán')</title>
@extends('Client.components.header')

@php
    use App\Models\Product;
    $productId = isset($_COOKIE['productChecked']) ? base64_decode($_COOKIE['productChecked']) : '';
    $productIds = array_filter(explode(',', $productId));
    $products = Product::whereIn('id', $productIds)->get();

    $subTotal = 0;

    foreach ($products as $product) {
        if ($product->price_sale !== null) {
            $subTotal += $product->price_sale;
        } else {
            $subTotal += $product->price;
        }
    }

@endphp

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
                    <form>
                        <fieldset>
                            <h2 class="login-title mb-3">Chi tiết đơn hàng</h2>
                            <div class="row mb-3">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <label for="input-firstname">Họ và tên</label>
                                    <input class="form-control" name="firstname" value="" id="input-firstname"
                                        type="text">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-email">Địa chỉ email</label>
                                    <input class="form-control" name="email" value="" id="input-email"
                                        type="email">
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                    <label for="input-telephone">Số điện thoại </label>
                                    <input class="form-control" name="phone" value="" id="input-telephone"
                                        type="tel">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row mb-3">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                                    <label for="input-address-1">Địa chỉ</label>
                                    <input class="form-control" name="address_1" value="" id="input-address-1"
                                        type="text">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row mb-3">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <label for="input-company">Ghi chú đơn hàng</label>
                                    <textarea class="form-control resize-both" rows="3"></textarea>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            {{-- đơn hàng --}}
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <h2 class="order-title">Đơn hàng của bạn</h2>
                <div class="your-order-payment">
                    <div class="your-order">

                        <ul class="list_order">
                            @foreach ($products as $product)
                                <li class="item_checkout mb-3 d-flex align-items-start">
                                    <img class="__custom_image" width="80px"
                                        src="{{ $product->image_cover ? $product->image_cover : '/no_image.jpg' }}"
                                        alt="{{ $product->name }}">
                                    <p class="__name_product_checkout"><span
                                            class="d-block w-75">{{ $product->name }}</span></p>
                                    <span>{{ number_format($product->price_sale !== null ? $product->price_sale : $product->sale, '0', '.', '.') }}
                                        đ</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="total">
                        <div class="row border-bottom mb-3">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Tạm tính:</span>
                            <span class="col-12 col-sm-6 text-right"><span
                                    id="subTotal">{{ number_format($subTotal, '0', '.', '.') }} đ</span></span>
                        </div>
                        <div class="row border-bottom mb-3">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Phí vận chuyển:</span>
                            <span class="col-12 col-sm-6 text-right"><span id="freeShipping">0 đ</span></span>
                        </div>
                        <div class="row border-bottom mb-3">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Tổng tiền:</span>
                            <span class="col-12 col-sm-6 text-right"><span id="totalAmout">0 đ</span></span>
                        </div>
                    </div>

                    <div class="your-payment">
                        <h2 class="payment-title mb-3">payment method</h2>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion" class="payment-section">
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <a class="card-link" data-bs-toggle="collapse" href="#collapseOne"
                                                role="button" aria-expanded="false" aria-controls="collapseOne">
                                                Direct Bank Transfer
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="collapse" data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <p class="no-margin font-15">Make your payment directly into our bank
                                                    account. Please use your Order ID as the payment reference. Your order
                                                    won't be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapseTwo"
                                                role="button" aria-expanded="false" aria-controls="collapseTwo">
                                                Cheque Payment
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <p class="no-margin font-15">Please send your cheque to Store Name, Store
                                                    Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <a class="collapsed card-link" data-bs-toggle="collapse"
                                                href="#collapseThree" role="button" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                PayPal
                                            </a>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <p class="no-margin font-15">Pay via PayPal; you can pay with your credit
                                                    card if you don't have a PayPal account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="order-button-payment">
                                <button class="btn" value="Place order" type="submit">Tiến hành thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Scoll Top-->
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    <!--End Scoll Top-->

    <!-- Including Jquery -->
    <script src="{{ asset('/') }}client/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('/') }}client/js/vendor/jquery.cookie.js"></script>
    <script src="{{ asset('/') }}client/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{ asset('/') }}client/js/vendor/wow.min.js"></script>
    <!-- Including Javascript -->
    <script src="{{ asset('/') }}client/js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}client/js/plugins.js"></script>
    <script src="{{ asset('/') }}client/js/popper.min.js"></script>
    <script src="{{ asset('/') }}client/js/lazysizes.js"></script>
    <script src="{{ asset('/') }}client/js/main.js"></script>
@endsection
