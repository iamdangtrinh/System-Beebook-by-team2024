<title>@yield('title', 'Giỏ hàng')</title>
@extends('layout.client')

@section('body')
    <!--Body Content-->
    <div id="page-content">
        {{-- <form action="{{route('checkout.index')}}" method="POST"> --}}
        <!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-width">Giỏ hàng</h1>
                </div>
            </div>
        </div>

        <!--End Page Title-->
        <div class="container">
            @if (count($result) !== 0)
                <div class="row gutter">
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                        {{-- <div class="alert alert-success text-uppercase" role="alert">
                            <i class="icon anm anm-truck-l icon-large"></i> &nbsp;<strong>Congratulations!</strong> You've
                            got free shipping!
                        </div> --}}

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered" style="white-space: nowrap;">
                                <thead class="cart__row cart__header">
                                    <tr>
                                        <th class="text-center d-none"><input type="checkbox" name="checkAll"
                                                id="checkAll"></th>
                                        <th colspan="2">Sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Tổng tiền</th>
                                        <th class="action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $cartItem)
                                        <tr class="cartItem cart__row border-bottom border-top">
                                            {{-- sản phẩm --}}
                                            @php
                                                $isAuthenticated = Auth::check();

                                                $products = $isAuthenticated ? $cartItem->cartProduct : [$cartItem];

                                                $price = $isAuthenticated ? $cartItem->price : $cartItem['price'];
                                                $quantity = $isAuthenticated
                                                    ? $cartItem->quantity
                                                    : $cartItem['quantity'];
                                                $idCart = $isAuthenticated ? $cartItem->id : 0;

                                                // dd($products->cartProduct);

                                            @endphp

                                            @foreach ($products as $product)
                                                <td class="text-center d-none">
                                                    <input name="id_product[]" class="inputCheckCart" checked
                                                        data-price="{{ $price }}"
                                                        data-id-product="{{ $isAuthenticated ? $product['id'] : $product['id'] }}"
                                                        data-max-quantity="{{ $isAuthenticated ? $product->quantity : $product['quantity_product'] }}"
                                                        data-id-cart="{{ $isAuthenticated ? $idCart : 0 }}"
                                                        value="{{ $isAuthenticated ? $cartItem->id : $product['id'] }}"
                                                        id="id_cart" type="checkbox">
                                                </td>

                                                {{-- Hình ảnh và tên --}}
                                                <td class="cart__image-wrapper cart-flex-item">
                                                    <a href="san-pham/{{ $isAuthenticated ? $product->slug : $product['slug'] }}">
                                                        <img class="cart__image"
                                                            src="{{ $isAuthenticated ? ($product->image_cover ? asset($product->image_cover) : asset('no_image.jpg')) : ($product['image_cover'] ? asset($product['image_cover']) : asset('no_image.jpg')) }}"
                                                            alt="{{ $isAuthenticated ? $product->name : $product['name'] }}">
                                                    </a>
                                                </td>

                                                <td class="cart__meta small--text-left cart-flex-item">
                                                    <div class="list-view-item__title">
                                                        <a class="name_product"
                                                            href="{{ $isAuthenticated ? $product->slug : $product['slug'] }}">
                                                            {{ $isAuthenticated ? $product->name : $product['name'] }}</a>
                                                    </div>
                                                    <span class="price_product mt-2 fw-bold d-block">
                                                        {{ number_format($price, 0, '.', '.') }} đ
                                                    </span>
                                                    <del>
                                                        @if (($isAuthenticated ? $product->price : $product['price']) != 0)
                                                            {{ number_format($isAuthenticated ? $product->price : $product['price_product'], 0, '.', '.') }}
                                                            đ
                                                        @endif
                                                    </del>
                                                </td>
                                            @endforeach

                                            {{-- Số lượng sản phẩm --}}
                                            <td class="cart__update-wrapper cart-flex-item text-center">
                                                <div class="cart__qty text-center">
                                                    <div class="qtyField">
                                                        <button type="button" class="qtyBtn qtyBtnMinus minus"
                                                            href="javascript:void(0);">
                                                            <i class="icon icon-minus"></i>
                                                        </button>

                                                        <input class="cart__qty-input qty" type="text" name="quantity[]"
                                                            id="qty" value="{{ $quantity }}">

                                                        <button type="button" class="qtyBtn qtyBtnPlus plus"
                                                            href="javascript:void(0);">
                                                            <i class="icon icon-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Tổng tiền --}}
                                            <td class="text-right cart-price">
                                                <span class="money" priceTotal="{{ $price * $quantity }}">
                                                    {{ number_format($price * $quantity, 0, '.', '.') }} đ
                                                </span>
                                            </td>

                                            {{-- Xóa sản phẩm --}}
                                            <td class="text-center">
                                                <a href="#" class="btn cart__remove removeProduct" title="">
                                                    <i class="icon icon anm anm-times-l"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- </div> --}}

                    {{-- mã giảm giá --}}
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 main-col">
                        <div class="solid-border mt-3">
                            <div class="row border-bottom pb-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Tạm tính:</span>
                                <span class="col-12 col-sm-6 text-right"><span class="subTotal">0 đ</span></span>
                            </div>
                            <div class="row border-bottom pb-2 pt-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Phương thức vận chuyển:</span>
                                <span class="col-12 col-sm-6 text-right">
                                    <img src="/Logo-GHN.webp" alt="">
                                    Giao hàng nhanh</span>
                            </div>
                            <div class="row border-bottom pb-2 pt-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Tổng cộng:</strong></span>
                                <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span
                                        class="totalAmout">0 đ</span></span>
                            </div>
                            <div class="cart__shipping">Vận chuyển &amp; thuế được tính khi thanh toán</div>


                            <a href="/checkout" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout"
                                value="checkout">Thanh toán</a>

                            <div class="paymnet-img"><img
                                    src="{{ asset('/') }}client/images/payment-img.jpg"alt="Payment"></div>
                        </div>
                    </div>
                    {{-- mã giảm giá --}}
                </div>
            @else
                <div class="__custom_cart_empty">
                    <img src="{{ asset('/') }}client/images/ico_emptycart.svg" alt="Cart empty">
                    <h4 class="">Chưa có sản phẩm trong giỏ hàng của bạn.</h4>
                    <a href="/" class="btn rounded btn-medium">Mua sắm ngay</a>
                </div>
            @endif
        </div>
        {{-- </form> --}}
    </div>
    <script src="{{ asset('/') }}client/js/customCart.js"></script>
    <script src="{{ asset('/') }}client/js/lib/toastr.js"></script>

@endsection
