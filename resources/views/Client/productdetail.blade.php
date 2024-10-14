<title>@yield('title', 'Chi tiết sách '.$product->name)</title>
@extends('Client.components.header')
@section('body')
<div id="page-content">
    <!--MainContent-->
    <div id="MainContent" class="main-content" role="main">
        <!--Breadcrumb-->
        <div class="bredcrumbWrap">
            <div class="container breadcrumbs">
                <a href="index.html" title="Back to the home page">Trang chủ</a><span
                    aria-hidden="true">›</span><span>Chi tiết sách {{$product->name}}</span>
            </div>
        </div>
        <!--End Breadcrumb-->

        <div id="ProductSection-product-template" class="product-template__container prstyle2 container">
            <!--#ProductSection-product-template-->
            <div class="product-single product-single-1">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="product-details-img product-single__photos bottom">
                            <div class="zoompro-wrap product-zoom-right pl-20">
                                <div class="zoompro-span">
                                    <img class="blur-up lazyload zoompro"
                                        data-zoom-image="{{ asset('/').$product->image_cover }}"
                                        alt="" src="{{ asset('/').$product->image_cover }}" />
                                </div>
                                <div class="product-labels"><span class="lbl on-sale">Sale</span><span
                                        class="lbl pr-label1">new</span></div>
                                <div class="product-buttons">
                                    @if($product->url_video)
                                    <a href="{{$product->url_video }}"
                                        class="btn popup-video" title="View Video"><i
                                            class="icon anm anm-play-r" aria-hidden="true"></i></a>
                                    @endif
                                    <a href="#" class="btn prlightbox" title="Zoom"><i
                                            class="icon anm anm-expand-l-arrows" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="product-thumb product-thumb-1">
                                <div id="gallery" class="product-dec-slider-1 product-tab-left">
                                    <a data-image="{{ asset('/').$product->image_cover }}"
                                        data-zoom-image="{{ asset('/').$product->image_cover }}"
                                        class="slick-slide slick-cloned" data-slick-index="-4"
                                        aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload"
                                            src="{{ asset('/').$product->image_cover }}" alt="" />
                                    </a>
                                    @foreach($product_meta as $meta)
                                    @if($meta['product_key'] == "thumbnail")
                                    @php
                                    $product_value = trim($meta['product_value']);

                                    $product_images = explode(",", $product_value);
                                    @endphp

                                    @foreach($product_images as $image)
                                    @php
                                    $image = trim($image, '" ');
                                    @endphp

                                    <a data-image="{{ asset($image) }}"
                                        data-zoom-image="{{ asset($image) }}"
                                        class="slick-slide slick-cloned" data-slick-index="-3"
                                        aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload"
                                            src="{{ asset($image) }}" alt="Product Image" />
                                    </a>
                                    @endforeach
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="lightboximages">
                                <a href="{{ asset('/').$product->image_cover }}"
                                    data-size="1462x2048"></a>
                                @foreach($product_meta as $meta)
                                @if($meta['product_key'] == "thumbnail")
                                @php
                                $product_value = trim($meta['product_value']);

                                $product_images = explode(",", $product_value);
                                @endphp

                                @foreach($product_images as $image)
                                @php
                                $image = trim($image, '" ');
                                @endphp

                                <a href="{{ asset($image) }}"
                                    data-size="1462x2048"></a>
                                @endforeach
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <!--Product Feature-->
                        <div class="prFeatures">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 feature">
                                    <img src="assets/images/credit-card.png" alt="Safe Payment"
                                        title="Safe Payment" />
                                    <div class="details">
                                        <h3>Safe Payment</h3>Pay with the world's most payment methods.
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 feature">
                                    <img src="assets/images/shield.png" alt="Confidence" title="Confidence" />
                                    <div class="details">
                                        <h3>Confidence</h3>Protection covers your purchase and personal data.
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 feature">
                                    <img src="assets/images/worldwide.png" alt="Worldwide Delivery"
                                        title="Worldwide Delivery" />
                                    <div class="details">
                                        <h3>Worldwide Delivery</h3>FREE &amp; fast shipping to over 200+
                                        countries &amp; regions.
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 feature">
                                    <img src="assets/images/phone-call.png" alt="Hotline" title="Hotline" />
                                    <div class="details">
                                        <h3>Hotline</h3>Talk to help line for your question on 4141 456 789,
                                        4125 666 888
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Product Feature-->
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="product-single__meta">
                            <h1 class="product-single__title">{{$product->name}}</h1>
                            <div class="product-nav clearfix">
                                <a href="#" class="next" title="Next"><i class="fa fa-angle-right"
                                        aria-hidden="true"></i></a>
                            </div>
                            <div class="prInfoRow">
                                <div class="product-stock">
                                    @if($product->quantity > 5)
                                    <span class="instock">Còn {{$product->quantity}} quyển sách</span>
                                    @elseif($product->quantity > 0 && $product->quantity <= 5)
                                        <span class="outstock">Còn {{$product->quantity}} quyển sách</span>
                                        @else
                                        <span class="outstock">Hết hàng</span>
                                        @endif
                                </div>
                                <div class="product-sku">Lượt xem: <span class="variant-sku">{{$product->views}}</span></div>
                                <div class="product-review">
                                    <a class="reviewLink">@for ($i = 1; $i <= 5; $i++)<i class="font-13 fa {{ $i <= $averageRating ? 'fa-star' : 'fa-star-o' }}"></i>@endfor</a>
                                    <span class="spr-summary-actions-togglereviews">{{ $commentCount }} bình luận</span>
                                </div>

                            </div>
                            <p class="product-single__price product-single__price-product-template">
                                @if(!$product->price_sale)
                                <span
                                    class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                    <span id="ProductPrice-product-template"><span
                                            class="money">{{ number_format($product->price, 0, ',', '.') }} đ</span></span>
                                </span>
                                @else
                                <span class="visually-hidden">Giá gốc</span>
                                <s id="ComparePrice-product-template"><span class="money">{{ number_format($product->price, 0, ',', '.') }} đ</span></s>
                                <span
                                    class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                    <span id="ProductPrice-product-template"><span
                                            class="money">{{ number_format($product->price_sale, 0, ',', '.') }} đ</span></span>
                                </span>
                                <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                                    <span>Tiết kiệm</span>
                                    <span id="SaveAmount-product-template" class="product-single__save-amount">
                                        <span class="money">{{ number_format($product->price-$product->price_sale, 0, ',', '.') }} đ</span>
                                    </span>
                                    <span class="off">(<span>{{ round((($product->price - $product->price_sale) / $product->price) * 100) }}</span>%)</span>
                                </span>
                                @endif
                            </p>
                            <form method="post" action="http://annimexweb.com/cart/add"
                                id="product_form_10508262282" accept-charset="UTF-8"
                                class="product-form product-form-product-template hidedropdown"
                                enctype="multipart/form-data">
                                <p class="infolinks"><a href="#sizechart" class="sizelink btn">Thông tin chi tiết</a>
                                    <a href="#productInquiry" class="emaillink btn">Hỏi về sách</a>
                                </p>
                                <!-- Product Action -->
                                <div class="product-action clearfix">
                                    <div class="product-form__item--quantity">
                                        <div class="wrapQtyBtn">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                        class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" id="Quantity" name="quantity" value="1"
                                                    class="product-form__input qty">
                                                <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                        class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-form__item--submit">
                                        <button type="button" name="add" class="btn product-form__cart-submit">
                                            <span>Thêm vào giỏ hàng</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- End Product Action -->
                            </form>
                            <div class="display-table shareRow">
                                <div class="display-table-cell medium-up--one-third">
                                    <div class="wishlist-btn">
                                        <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist"><i
                                                class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Thêm vào yêu thích</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Product Tabs-->
                        <div class="tabs-listing">
                            <div class="tab-container">
                                <h3 class="acor-ttl active" rel="tab1">Mô tả sách</h3>
                                <div id="tab1" class="tab-content">
                                    <div class="product-description rte">
                                    {!! str_replace(['{', '}'], '', $product->description) !!}
                                    </div>
                                </div>
                                <h3 class="acor-ttl" rel="tab2">Thông tin chi tiết</h3>
                                <div id="tab2" class="tab-content">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>Size</th>
                                                <td>XS</td>
                                            </tr>
                                            @foreach($product_meta as $meta)
                                            @if($meta->product_key == "form")
                                            <tr>
                                                <th>Hình thức</th>
                                                <td>{{$meta->product_value}}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            <tr>
                                                <th>Năm XB</th>
                                                <td>{{$product->year}}</td>
                                            </tr>
                                            <tr>
                                                <th>Trọng lượng (gr)</th>
                                                <td>{{$product->weight}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--End Product Tabs-->
                    </div>
                </div>
                <!--End-product-single-->

                <!--Related Product Slider-->
                <div class="related-product grid-products">
                    <header class="section-header">
                        <h2 class="section-header__title text-center h2"><span>Sách tương tự</span></h2>
                        <p class="sub-heading">Có thể bạn quan tâm, dưới đây là các sách tương tự để bạn có thể dễ dàng chọn lựa.</p>
                    </header>
                    <div class="productPageSlider row">
                        @foreach($product_same as $pro)
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                            <!-- start product image -->
                            <div class="product-image">
                                <!-- start product image -->
                                <a href="{{ asset('san-pham/' . $pro->slug) }}" class="grid-view-item__link">
                                    <!-- image -->
                                    <img class="primary lazyload"
                                        data-src="{{ asset('/').$pro->image_cover }}"
                                        src="{{ asset('/').$pro->image_cover }}"
                                        alt="image" title="product">
                                    <!-- End image -->
                                </a>
                                <!-- end product image -->

                                <!-- Start product button -->
                                <form class="variants add" action="#"
                                    onclick="window.location.href='cart.html'" method="post">
                                    <button class="btn btn-addto-cart" type="button" tabindex="0">Thêm vào giỏ hàng</button>
                                </form>
                                <div class="button-set">
                                    <div class="wishlist-btn">
                                        <a class="wishlist add-to-wishlist" href="wishlist.html">
                                            <i class="icon anm anm-heart-l"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- end product button -->
                            </div>
                            <!-- end product image -->
                            <!--start product details -->
                            <div class="product-details text-center">
                                <!-- product name -->
                                <div class="product-name">
                                    <a href="{{ asset('san-pham/' . $pro->slug) }}">{{$pro->name}}</a>
                                </div>
                                <!-- End product name -->
                                <!-- product price -->
                                <div class="product-price">
                                    @if(!$pro->price_sale)
                                    <span class="price">{{ number_format($product->price, 0, ',', '.') }} đ</span>
                                    @else
                                    <span class="old-price">{{ number_format($product->price, 0, ',', '.') }} đ</span>
                                    <span class="price">{{ number_format($product->price_sale, 0, ',', '.') }} đ</span>
                                    @endif
                                </div>
                                <!-- End product price -->
                            </div>
                            <!-- End product details -->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--End Related Product Slider-->
                <div id="shopify-product-reviews">
                    <div id="comments" class="spr-container">
                        <div class="spr-header clearfix">
                            <div class="spr-summary">
                                <span class="product-review">
                                    <a class="reviewLink">@for ($i = 1; $i <= 5; $i++)<i class="font-13 fa {{ $i <= $averageRating ? 'fa-star' : 'fa-star-o' }}"></i>@endfor</a>
                                    <span class="spr-summary-actions-togglereviews">{{ $commentCount }} bình luận</span>
                                </span>
                                <span class="spr-summary-actions">
                                    <a href="#"
                                        class="spr-summary-actions-newreview btn">Viết bình luận</a>
                                </span>
                            </div>
                        </div>
                        <div class="spr-content">
                            <div class="spr-form clearfix">
                                <form method="post" action="#" id="new-review-form"
                                    class="new-review-form">
                                    <h3 class="spr-form-title">Viết bình luận</h3>
                                    <fieldset class="spr-form-review">
                                        <div class="spr-form-review-rating">
                                            <label class="spr-form-label">Rating</label>
                                            <span class="star-rating">
                                                <label for="rate-1" style="--i:1"><i class="fa fa-star"></i></label>
                                                <input type="radio" name="rating" id="rate-1" value="1">
                                                <label for="rate-2" style="--i:2"><i class="fa fa-star"></i></label>
                                                <input type="radio" name="rating" id="rate-2" value="2">
                                                <label for="rate-3" style="--i:3"><i class="fa fa-star"></i></label>
                                                <input type="radio" name="rating" id="rate-3" value="3">
                                                <label for="rate-4" style="--i:4"><i class="fa fa-star"></i></label>
                                                <input type="radio" name="rating" id="rate-4" value="4">
                                                <label for="rate-5" style="--i:5"><i class="fa fa-star"></i></label>
                                                <input type="radio" name="rating" id="rate-5" value="5">
                                            </span>
                                        </div>

                                        <div class="spr-form-review-body">
                                            <label class="spr-form-label"
                                                for="review_body_10508262282">Nội dung</label>
                                            <div class="spr-form-input">
                                                <textarea
                                                    class="spr-form-input spr-form-input-textarea "
                                                    id="review_body_10508262282"
                                                    data-product-id="10508262282"
                                                    name="content" rows="10"
                                                    placeholder="Viết bình luận ở đây"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="spr-form-actions">
                                        <input type="submit"
                                            class="spr-button spr-button-primary button button-primary btn btn-primary"
                                            value="Gửi bình luận">
                                    </fieldset>
                                </form>
                            </div>
                            <div class="spr-reviews">
                                @if(!$comments)
                                @foreach($comments as $comment)
                                <div class="spr-review">
                                    <div class="spr-review-header">
                                        <span
                                            class="product-review spr-starratings spr-review-header-starratings"><span
                                                class="reviewLink"><i
                                                    class="fa fa-star"></i><i
                                                    class="font-13 fa fa-star"></i><i
                                                    class="font-13 fa fa-star"></i><i
                                                    class="font-13 fa fa-star"></i><i
                                                    class="font-13 fa fa-star"></i></span></span></br>
                                        <span
                                            class="spr-review-header-byline"><strong>{{$comment->user->name}}</strong>
                                            {{ $comment->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="spr-review-content">
                                        <p class="spr-review-content-body">{{$comment->content}}</p>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p>Chưa có bình luận. Hãy là người đầu tiên bình luận về sách này nào!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--#ProductSection-product-template-->
        </div>
        <!--MainContent-->
    </div>
    <!--End Body Content-->

    <!--Footer-->
    <footer id="footer">
        <div class="newsletter-section">
            <div class="container">
                <div class="row">
                    <div
                        class="col-12 col-sm-12 col-md-12 col-lg-7 w-100 d-flex justify-content-start align-items-center">
                        <div class="display-table">
                            <div class="display-table-cell footer-newsletter">
                                <div class="section-header text-center">
                                    <label class="h2"><span>sign up for </span>newsletter</label>
                                </div>
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="email" class="input-group__field newsletter__input"
                                            name="EMAIL" value="" placeholder="Email address" required="">
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
                    <div
                        class="col-12 col-sm-12 col-md-12 col-lg-5 d-flex justify-content-end align-items-center">
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

    <div class="hide">
        <div id="sizechart">
            <h3>WOMEN'S BODY SIZING CHART</h3>
            <table>
                <tbody>
                    <tr>
                        <th>Size</th>
                        <th>XS</th>
                        <th>S</th>
                        <th>M</th>
                        <th>L</th>
                        <th>XL</th>
                    </tr>
                    <tr>
                        <td>Chest</td>
                        <td>31" - 33"</td>
                        <td>33" - 35"</td>
                        <td>35" - 37"</td>
                        <td>37" - 39"</td>
                        <td>39" - 42"</td>
                    </tr>
                    <tr>
                        <td>Waist</td>
                        <td>24" - 26"</td>
                        <td>26" - 28"</td>
                        <td>28" - 30"</td>
                        <td>30" - 32"</td>
                        <td>32" - 35"</td>
                    </tr>
                    <tr>
                        <td>Hip</td>
                        <td>34" - 36"</td>
                        <td>36" - 38"</td>
                        <td>38" - 40"</td>
                        <td>40" - 42"</td>
                        <td>42" - 44"</td>
                    </tr>
                    <tr>
                        <td>Regular inseam</td>
                        <td>30"</td>
                        <td>30½"</td>
                        <td>31"</td>
                        <td>31½"</td>
                        <td>32"</td>
                    </tr>
                    <tr>
                        <td>Long (Tall) Inseam</td>
                        <td>31½"</td>
                        <td>32"</td>
                        <td>32½"</td>
                        <td>33"</td>
                        <td>33½"</td>
                    </tr>
                </tbody>
            </table>
            <h3>MEN'S BODY SIZING CHART</h3>
            <table>
                <tbody>
                    <tr>
                        <th>Size</th>
                        <th>XS</th>
                        <th>S</th>
                        <th>M</th>
                        <th>L</th>
                        <th>XL</th>
                        <th>XXL</th>
                    </tr>
                    <tr>
                        <td>Chest</td>
                        <td>33" - 36"</td>
                        <td>36" - 39"</td>
                        <td>39" - 41"</td>
                        <td>41" - 43"</td>
                        <td>43" - 46"</td>
                        <td>46" - 49"</td>
                    </tr>
                    <tr>
                        <td>Waist</td>
                        <td>27" - 30"</td>
                        <td>30" - 33"</td>
                        <td>33" - 35"</td>
                        <td>36" - 38"</td>
                        <td>38" - 42"</td>
                        <td>42" - 45"</td>
                    </tr>
                    <tr>
                        <td>Hip</td>
                        <td>33" - 36"</td>
                        <td>36" - 39"</td>
                        <td>39" - 41"</td>
                        <td>41" - 43"</td>
                        <td>43" - 46"</td>
                        <td>46" - 49"</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="hide">
        <div id="productInquiry">
            <div class="contact-form form-vertical">
                <div class="page-title">
                    <h3>Camelia Reversible Jacket</h3>
                </div>
                <form method="post" action="#" id="contact_form" class="contact-form">
                    <input type="hidden" name="form_type" value="contact" />
                    <input type="hidden" name="utf8" value="✓" />
                    <div class="formFeilds">
                        <input type="hidden" name="contact[product name]" value="Camelia Reversible Jacket">
                        <input type="hidden" name="contact[product link]"
                            value="/products/camelia-reversible-jacket-black-red">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="text" id="ContactFormName" name="contact[name]" placeholder="Name"
                                    value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <input type="email" id="ContactFormEmail" name="contact[email]"
                                    placeholder="Email" autocapitalize="off" value="" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <input required type="tel" id="ContactFormPhone" name="contact[phone]"
                                    pattern="[0-9\-]*" placeholder="Phone Number" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <textarea required rows="10" id="ContactFormMessage" name="contact[body]"
                                    placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn" value="Send Message">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


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
    <!-- Photoswipe Gallery -->
    <script src="{{ asset('/') }}client/js/vendor/photoswipe.min.js"></script>
    <script src="{{ asset('/') }}client/js/vendor/photoswipe-ui-default.min.js"></script>
    <script>
        $(function() {
            var $pswp = $('.pswp')[0],
                image = [],
                getItems = function() {
                    var items = [];
                    $('.lightboximages a').each(function() {
                        var $href = $(this).attr('href'),
                            $size = $(this).data('size').split('x'),
                            item = {
                                src: $href,
                                w: $size[0],
                                h: $size[1]
                            }
                        items.push(item);
                    });
                    return items;
                }
            var items = getItems();

            $.each(items, function(index, value) {
                image[index] = new Image();
                image[index].src = value['src'];
            });
            $('.prlightbox').on('click', function(event) {
                event.preventDefault();

                var $index = $(".active-thumb").parent().attr('data-slick-index');
                $index++;
                $index = $index - 1;

                var options = {
                    index: $index,
                    bgOpacity: 0.9,
                    showHideOpacity: true
                }
                var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                lightBox.init();
            });
        });
    </script>
</div>
</div>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div><button class="pswp__button pswp__button--close"
                    title="Close (Esc)"></button><button class="pswp__button pswp__button--share"
                    title="Share"></button><button class="pswp__button pswp__button--fs"
                    title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom"
                    title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div><button class="pswp__button pswp__button--arrow--left"
                title="Previous (arrow left)"></button><button class="pswp__button pswp__button--arrow--right"
                title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>

</body>

<!-- belle/product-layout-2.html   11 Nov 2019 12:42:40 GMT -->

</html>
@endsection