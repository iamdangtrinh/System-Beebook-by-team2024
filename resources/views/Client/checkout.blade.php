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

        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        .select2-container--default .select2-selection--single {
            border: var(--bs-border-width) solid var(--bs-border-color) !important;
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
            {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                <div class="checkout bg-light-gray padding-20px-all">
                    <form>
                        <h2 class="login-title mb-3">Chi tiết đơn hàng</h2>

                        <fieldset>
                            <div class="form-group mb-3 col-md-12 col-lg-12 col-xl-12 required">
                                <label for="provincer">Thành phố/Tỉnh</label>
                                <input class="form-control setupSelect2" name="provincer" value="" id="provincer"
                                    type="text">
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col-md-12 col-lg-6 col-xl-6 required">
                                    <label for="district">Quận/Huyện</label>
                                    <input class="form-control setupSelect2" name="district" value="" id="district"
                                        type="text">
                                </div>
                                <div class="form-group col-md-12 col-lg-6 col-xl-6 required">
                                    <label for="ward">Xã/Phường</label>
                                    <input class="form-control setupSelect2" name="ward" value="" id="ward"
                                        type="text">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row mb-3">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                                    <label for="input-address-1">Địa chỉ</label>
                                    <input class="form-control" name="address" value="" id="input-address-autocomplte"
                                        type="text">
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
                    </form>
                </div>
            </div> --}}

            {{-- đơn hàng --}}
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
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
                                    <span>{{ number_format($product->price_sale !== null ? $product->price_sale : $product->price, '0', '.', '.') }}
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
                            <span class="col-12 col-sm-6 text-right"><span id="freeShipping">20.000 đ</span></span>
                        </div>
                        <div class="row border-bottom mb-3">
                            <span class="col-12 col-sm-6 cart__subtotal-title">Tổng tiền:</span>
                            <span class="col-12 col-sm-6 text-right"><span id="totalAmout">
                                    {{ number_format($subTotal + 20000, '0', '.', '.') }} đ</span></span>
                        </div>
                    </div>

                    <div class="your-payment">
                        <h4 class="payment-title mb-3">Phương thức thanh toán</h4>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion" class="payment-section">

                                    @foreach (config('checkout.payment.paymentCheckout') as $method)
                                        <div class="card mb-2">
                                            <div class="card-header d-flex">
                                                <input type="radio" id="{{ $method['value'] }}" name="payment"
                                                    value="{{ $method['method'] }}">

                                                <label for="{{ $method['value'] }}" class="mx-2 card-link w-100"
                                                    data-bs-toggle="collapse" href="#{{ $method['method'] }}"
                                                    role="button" aria-expanded="false"
                                                    aria-controls="{{ $method['method'] }}">
                                                    {{ $method['title'] }}
                                                </label>
                                            </div>

                                            <div id="{{ $method['method'] }}" class="collapse" data-bs-parent="#accordion">
                                                <div class="card-body">
                                                    <p class="no-margin font-15">{{ $method['description'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                    <label for="input-company">Ghi chú đơn hàng</label>
                                    <textarea class="form-control resize-both" name="note" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="order-button-payment">
                                <button class="btn w-100" value="Place order" type="submit">Tiến hành thanh toán</button>
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

    <script src="{{ asset('/') }}client/js/customCheckout.js"></script>

    {{-- lo dash --}}
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
