<title>@yield('title', 'Giỏ hàng')</title>
@extends('Client.components.header')

@section('body')
    <!--Body Content-->
    <div id="page-content">
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
                        <div class="table-responsive">
                            <table class="table table-bordered" style="white-space: nowrap;">
                                <thead class="cart__row cart__header">
                                    <tr>
                                        <th class="text-center"><input type="checkbox" name="checkAll" id="checkAll"></th>
                                        <th colspan="2">Sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Tổng tiền</th>
                                        <th class="action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $cartItem)
                                        <tr class="cartItem cart__row border-bottom border-top">
                                            {{-- data pro --}}
                                            @php
                                                $isAuthenticated = Auth::user();
                                                $products = $isAuthenticated ? $cartItem->cartProduct : [$cartItem];
                                                $price = $isAuthenticated ? $cartItem->price : $cartItem['price'];
                                                $quantity = $isAuthenticated
                                                    ? $cartItem->quantity
                                                    : $cartItem['quantity'];
                                            @endphp

                                            @foreach ($products as $product)
                                                <td class="text-center">
                                                    <input class="inputCheckCart" data-price="{{ $price }}"
                                                        data-id-product="{{ $isAuthenticated ? $product->id : $product['id'] }}"
                                                        data-max-quantity="{{ $isAuthenticated ? $product->quantity : $product['quantity_product'] }}"
                                                        value="{{ $isAuthenticated ? $cartItem->id : $product['id'] }}"
                                                        id="id_cart" type="checkbox">
                                                </td>

                                                {{-- Hình ảnh và tên --}}
                                                <td class="cart__image-wrapper cart-flex-item">
                                                    <a href="{{ $isAuthenticated ? $product->slug : $product['slug'] }}">
                                                        <img class="cart__image"
                                                            src="{{ $isAuthenticated ? ($product->image_cover ? asset($product->image_cover) : asset('no_image.jpg')) : ($product['image_cover'] ? asset($product['image_cover']) : asset('no_image.jpg')) }}"
                                                            alt="{{ $isAuthenticated ? $product->name : $product['name'] }}">
                                                    </a>
                                                </td>

                                                <td class="cart__meta small--text-left cart-flex-item">
                                                    <div class="list-view-item__title name_product">
                                                        <a
                                                            href="{{ $isAuthenticated ? $product->slug : $product['slug'] }}">
                                                            {{ $isAuthenticated ? $product->name : $product['name'] }}
                                                        </a>
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
                                                        <input class="cart__qty-input qty" type="text" name="updates"
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
                        {{-- mã giảm giá --}}
                        <h5 class="title_coupon">Khuyến mãi</h5>
                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="address_zip">Enter your coupon code if you have one.</label>
                                <input type="text" name="coupon">
                            </div>
                            <div class="actionRow">
                                <button type="button" class="btn w-100">Apply Coupon</button>
                            </div>
                        </form>

                        <div class="solid-border mt-3">
                            <div class="row border-bottom pb-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Tạm tính:</span>
                                <span class="col-12 col-sm-6 text-right"><span class="subTotal">0 đ</span></span>
                            </div>
                            <div class="row border-bottom pb-2 pt-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title">Phương thức vận chuyển:</span>
                                <span class="col-12 col-sm-6 text-right">Free shipping</span>
                            </div>
                            <div class="row border-bottom pb-2 pt-2">
                                <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Tổng cộng:</strong></span>
                                <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span
                                        class="money">0 đ</span></span>
                            </div>
                            <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                            <p class="cart_tearm">
                                <label>
                                    <input type="checkbox" name="tearm" class="checkbox" value="tearm" required="">
                                    I agree with the terms and conditions
                                </label>
                            </p>
                            <input type="submit" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout"
                                value="Proceed To Checkout" disabled="disabled">
                            <div class="paymnet-img"><img src="{{ asset('/') }}client/images/payment-img.jpg"
                                    alt="Payment"></div>
                            <p><a href="#;">Checkout with Multiple Addresses</a></p>
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
    </div>

    </div>

    <!--Footer-->
    <footer id="footer">
        <div class="newsletter-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-7 w-100 d-flex justify-content-start align-items-center">
                        <div class="display-table">
                            <div class="display-table-cell footer-newsletter">
                                <div class="section-header text-center">
                                    <label class="h2"><span>sign up for </span>newsletter</label>
                                </div>
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="email" class="input-group__field newsletter__input" name="EMAIL"
                                            value="" placeholder="Email address" required="">
                                        <span class="input-group__btn">
                                            <button type="submit" class="btn newsletter__submit" name="commit"
                                                id="Subscribe"><span
                                                    class="newsletter__submit-text--large">Subscribe</span></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-5 d-flex justify-content-end align-items-center">
                        <div class="footer-social">
                            <ul class="list--inline site-footer__social-icons social-icons">
                                <li><a class="social-icons__link" href="#" target="_blank"
                                        title="Belle Multipurpose Bootstrap 4 Template on Facebook"><i
                                            class="icon icon-facebook"></i></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank"
                                        title="Belle Multipurpose Bootstrap 4 Template on Twitter"><i
                                            class="icon icon-twitter"></i> <span
                                            class="icon__fallback-text">Twitter</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank"
                                        title="Belle Multipurpose Bootstrap 4 Template on Pinterest"><i
                                            class="icon icon-pinterest"></i> <span
                                            class="icon__fallback-text">Pinterest</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank"
                                        title="Belle Multipurpose Bootstrap 4 Template on Instagram"><i
                                            class="icon icon-instagram"></i> <span
                                            class="icon__fallback-text">Instagram</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank"
                                        title="Belle Multipurpose Bootstrap 4 Template on Tumblr"><i
                                            class="icon icon-tumblr-alt"></i> <span
                                            class="icon__fallback-text">Tumblr</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank"
                                        title="Belle Multipurpose Bootstrap 4 Template on YouTube"><i
                                            class="icon icon-youtube"></i> <span
                                            class="icon__fallback-text">YouTube</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank"
                                        title="Belle Multipurpose Bootstrap 4 Template on Vimeo"><i
                                            class="icon icon-vimeo-alt"></i> <span
                                            class="icon__fallback-text">Vimeo</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-footer">
            <div class="container">
                <!--Footer Links-->
                <div class="footer-top">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                            <h4 class="h4">Quick Shop</h4>
                            <ul>
                                <li><a href="#">Women</a></li>
                                <li><a href="#">Men</a></li>
                                <li><a href="#">Kids</a></li>
                                <li><a href="#">Sportswear</a></li>
                                <li><a href="#">Sale</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                            <h4 class="h4">Informations</h4>
                            <ul>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Privacy policy</a></li>
                                <li><a href="#">Terms &amp; condition</a></li>
                                <li><a href="#">My Account</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                            <h4 class="h4">Customer Services</h4>
                            <ul>
                                <li><a href="#">Request Personal Data</a></li>
                                <li><a href="#">FAQ's</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Support Center</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box">
                            <h4 class="h4">Contact Us</h4>
                            <ul class="addressFooter">
                                <li><i class="icon anm anm-map-marker-al"></i>
                                    <p>55 Gallaxy Enque,<br>2568 steet, 23568 NY</p>
                                </li>
                                <li class="phone"><i class="icon anm anm-phone-s"></i>
                                    <p>(440) 000 000 0000</p>
                                </li>
                                <li class="email"><i class="icon anm anm-envelope-l"></i>
                                    <p>sales@yousite.com</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--End Footer Links-->
                <hr>
                <div class="footer-bottom">
                    <div class="row">
                        <!--Footer Copyright-->
                        <div
                            class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-0 order-lg-0 order-sm-1 copyright text-sm-center text-md-left text-lg-left">
                            <span></span> <a href="templateshub.net">Templates Hub</a>
                        </div>
                        <!--End Footer Copyright-->
                        <!--Footer Payment Icon-->
                        <div
                            class="col-12 col-sm-12 col-md-6 col-lg-6 order-0 order-md-1 order-lg-1 order-sm-0 payment-icons text-right text-md-center">
                            <ul class="payment-icons list--inline">
                                <li><i class="icon fa fa-cc-visa" aria-hidden="true"></i></li>
                                <li><i class="icon fa fa-cc-mastercard" aria-hidden="true"></i></li>
                                <li><i class="icon fa fa-cc-discover" aria-hidden="true"></i></li>
                                <li><i class="icon fa fa-cc-paypal" aria-hidden="true"></i></li>
                                <li><i class="icon fa fa-cc-amex" aria-hidden="true"></i></li>
                                <li><i class="icon fa fa-credit-card" aria-hidden="true"></i></li>
                            </ul>
                        </div>
                        <!--End Footer Payment Icon-->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--End Footer-->
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
    <script src="{{ asset('/') }}client/js/customCart.js"></script>
    <script src="{{ asset('/') }}client/js/lib/toastr.js"></script>

    </div>
    </body>

    </html>
@endsection
