@extends('Client.components.header')
@section('body')
    <!--Body Content-->
    <div id="page-content">
        <!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-width">Shopping Cart</h1>
                </div>
            </div>
        </div>
        <!--End Page Title-->

        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                    <div class="alert alert-success text-uppercase" role="alert">
                        <i class="icon anm anm-truck-l icon-large"></i> &nbsp;<strong>Congratulations!</strong> You've got
                        free shipping!
                    </div>
                    <form action="#" method="post" class="cart style2">
                        <table>
                            <thead class="cart__row cart__header">
                                <tr>
                                    <th colspan="2" class="text-center">Sản phẩm</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-right">Tổng tiền</th>
                                    <th class="action">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($result as $cart)
                                    <tr class="cart__row border-bottom line1 cart-flex border-top">
                                        <td class="cart__image-wrapper cart-flex-item">
                                            <a href="#"><img class="cart__image"
                                                    src="{{ asset('/') }}client/images/product-images/product-image30.jpg"
                                                    alt="Elastic Waist Dress - Navy / Small"></a>
                                        </td>
                                        <td class="cart__meta small--text-left cart-flex-item">
                                            <div class="list-view-item__title">
                                                <a href="#">abc</a>
                                            </div>
                                        </td>
                                        <td class="cart__price-wrapper cart-flex-item">
                                            <span class="money">{{number_format($cart->price, 0, '.', '.')}} VNĐ</span>
                                        </td>
                                        <td class="cart__update-wrapper cart-flex-item text-right">
                                            <div class="cart__qty text-center">
                                                <div class="qtyField">
                                                    <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                            class="icon icon-minus"></i></a>
                                                    <input class="cart__qty-input qty" type="text" name="updates[]"
                                                        id="qty" value="{{$cart->quantity}}" pattern="[0-9]*">
                                                    <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                            class="icon icon-plus"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right small--hide cart-price">
                                            <div><span class="money">{{number_format($cart->price * $cart->quantity, 0, '.', '.')}} VNĐ</span></div>
                                        </td>
                                        <td class="text-center small--hide"><a href="#"
                                                class="btn btn--secondary cart__remove" title="Remove tem"><i
                                                    class="icon icon anm anm-times-l"></i></a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-left"><a href="http://annimexweb.com/"
                                            class="btn btn-secondary btn--small cart-continue">Continue shopping</a></td>
                                    <td colspan="3" class="text-right">
                                        <button type="submit" name="clear"
                                            class="btn btn-secondary btn--small  small--hide">Clear Cart</button>
                                        <button type="submit" name="update"
                                            class="btn btn-secondary btn--small cart-continue ml-2">Update Cart</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>


                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                            <h5>Discount Codes</h5>
                            <form action="#" method="post">
                                <div class="form-group">
                                    <label for="address_zip">Enter your coupon code if you have one.</label>
                                    <input type="text" name="coupon">
                                </div>
                                <div class="actionRow">
                                    <div><input type="button" class="btn btn-secondary btn--small" value="Apply Coupon">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
                            <div class="solid-border">
                                <div class="row border-bottom pb-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">Subtotal</span>
                                    <span class="col-12 col-sm-6 text-right"><span class="money">$735.00</span></span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">Tax</span>
                                    <span class="col-12 col-sm-6 text-right">$10.00</span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title">Shipping</span>
                                    <span class="col-12 col-sm-6 text-right">Free shipping</span>
                                </div>
                                <div class="row border-bottom pb-2 pt-2">
                                    <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Grand Total</strong></span>
                                    <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span
                                            class="money">$1001.00</span></span>
                                </div>
                                <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                                <p class="cart_tearm">
                                    <label>
                                        <input type="checkbox" name="tearm" class="checkbox" value="tearm"
                                            required="">
                                        I agree with the terms and conditions
                                    </label>
                                </p>
                                <input type="submit" name="checkout" id="cartCheckout"
                                    class="btn btn--small-wide checkout" value="Proceed To Checkout" disabled="disabled">
                                <div class="paymnet-img"><img src="{{ asset('/') }}client/images/payment-img.jpg"
                                        alt="Payment"></div>
                                <p><a href="#;">Checkout with Multiple Addresses</a></p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--End Body Content-->

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
                            <span></span> <a href="templateshub.net">Templates Hub</a></div>
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
    </div>
    </body>

    <!-- belle/cart-variant1.html   11 Nov 2019 12:44:32 GMT -->

    </html>
@endsection
