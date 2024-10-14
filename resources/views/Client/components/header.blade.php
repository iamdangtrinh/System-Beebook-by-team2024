<!DOCTYPE html>
<html class="no-js" lang="en">

@php
    define('CSS_VER', '1.0.1');
@endphp

<head>
    @yield('title')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta name="description"
        content="Sách tiếng Việt - Beebook hệ thống nhà sách chuyên nghiệp. Đáp ứng tất cả các yêu cầu về sách.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:url" content="/" />
    <meta property="og:type"
        content="Sách tiếng Việt - Beebook hệ thống nhà sách chuyên nghiệp. Đáp ứng tất cả các yêu cầu về sách." />
    <meta property="og:image" content="{{ asset('/') }}client/images/favicon.png" />
    <link rel="shortcut icon" href="{{ asset('/') }}client/images/favicon.png" />
    <link rel="stylesheet" href="{{ asset('/') }}client/css/plugins.css?ver=@php echo CSS_VER @endphp">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}client/css/bootstrap.min.css?ver=@php echo CSS_VER @endphp">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}client/css/style.css?ver=@php echo CSS_VER @endphp">
    <link rel="stylesheet" href="{{ asset('/') }}client/css/responsive.css?ver=@php echo CSS_VER @endphp">
    <link rel="stylesheet" href="{{ asset('/') }}client/css/custom_css.css?ver=@php echo CSS_VER @endphp">

    {{-- toast message start by trinh --}}
    <script src="{{ asset('/') }}client/js/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/') }}client/js/lib/toastr.css?ver=@php echo CSS_VER @endphp">
    <script src="{{ asset('/') }}client/js/lib/toastr.js?ver=@php echo CSS_VER @endphp"></script>
    {{-- sweetalert2 --}}
    <script src="{{ asset('/') }}client/js/lib/sweetalert2.js?ver=@php echo CSS_VER @endphp"></script>
    {{-- toast message end --}}

    {{-- swiper start --}}
    <link rel="stylesheet"
        href="{{ asset('/') }}client/js/lib/swiper/swiper-bundle.min.css?ver=@php echo CSS_VER @endphp" />
    <script src="{{ asset('/') }}client/js/lib/swiper/swiper-bundle.min.js?ver=@php echo CSS_VER @endphp"></script>
    {{-- swiper end --}}

    <!-- Google tag (gtag.js) -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-N7WWXVQLYT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-N7WWXVQLYT');
    </script> --}}

    <script>
        let loading = `<i class="removeLoading fa fa-spinner fa-spin" style="font-size:24px"></i>`;
    </script>

</head>

<body class="template belle">
    <div class="pageWrapper">
        <!--Top Header-->
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-10 col-sm-8 col-md-5 col-lg-8">
                        <p class="phone-no"><i class="anm anm-phone-s"></i> +440 0(111) 044 833</p>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                        <div class="text-center">
                            <p class="top-header_middle-text"> Worldwide Express Shipping</p>
                        </div>
                    </div>
                    <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                        <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al"
                                aria-hidden="true"></i></span>
                        <ul class="customer-links list-inline">
                            @if (Auth::check())
                                <li><a href="{{ asset('/logout') }}">Logout</a></li>
                            @else
                                <li><a href="{{ asset('/sign-in') }}">Login</a></li>
                                <li><a href="{{ asset('/sign-up') }}">Create Account</a></li>
                            @endif
                            <li><a href="wishlist.html">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--End Top Header-->
        <!--Header-->
        <div class="header-wrap animated d-flex border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <!--Desktop Logo-->
                    <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                        <a href="{{ asset('/') }}">
                            <img src="{{ asset('/') }}client/images/logo.svg" alt="Belle Multipurpose Html Template"
                                title="Logo" />
                        </a>
                    </div>
                    <!--End Desktop Logo-->
                    <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                        <div class="d-block d-lg-none">
                            <button type="button"
                                class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                                <i class="icon anm anm-times-l"></i>
                                <i class="anm anm-bars-r"></i>
                            </button>
                        </div>
                        <!--Desktop Menu-->
                        <nav class="grid__item" id="AccessibleNav"><!-- for mobile -->
                            <ul id="siteNav" class="site-nav medium center hidearrow">
                                <li class="lvl1 parent megamenu"><a href="#">Home <i class="anm anm-angle-down-l"></i></a></li>
                                <li class="lvl1 parent megamenu"><a href="#">Shop <i class="anm anm-angle-down-l"></i></a></li>

                                <li class="lvl1 parent dropdown"><a href="#">Product <i class="anm anm-angle-down-l"></i></a>
                                    <ul class="dropdown">
                                        <li><a href="cart-variant1.html" class="site-nav">Cart Page <i
                                                    class="anm anm-angle-right-l"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="cart-variant1.html" class="site-nav">Cart Variant1</a>
                                                </li>
                                                <li><a href="cart-variant2.html" class="site-nav">Cart Variant2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="compare-variant1.html" class="site-nav">Compare Product <i
                                                    class="anm anm-angle-right-l"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="compare-variant1.html" class="site-nav">Compare
                                                        Variant1</a></li>
                                                <li><a href="compare-variant2.html" class="site-nav">Compare
                                                        Variant2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="checkout.html" class="site-nav">Checkout</a></li>
                                        <li><a href="about-us.html" class="site-nav">About Us <span
                                                    class="lbl nm_label1">New</span> </a></li>
                                        <li><a href="contact-us.html" class="site-nav">Contact Us</a></li>
                                        <li><a href="faqs.html" class="site-nav">FAQs</a></li>
                                        <li><a href="lookbook1.html" class="site-nav">Lookbook<i
                                                    class="anm anm-angle-right-l"></i></a>
                                            <ul>
                                                <li><a href="lookbook1.html" class="site-nav">Style 1</a></li>
                                                <li><a href="lookbook2.html" class="site-nav">Style 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="404.html" class="site-nav">404</a></li>
                                        <li><a href="coming-soon.html" class="site-nav">Coming soon <span
                                                    class="lbl nm_label1">New</span> </a></li>
                                    </ul>
                                </li>
                                <li class="lvl1 parent dropdown"><a href="#">Pages <i
                                            class="anm anm-angle-down-l"></i></a>

                                </li>
                                <li class="lvl1 parent dropdown"><a href="#">Blog <i
                                            class="anm anm-angle-down-l"></i></a>
                                    <ul class="dropdown">
                                        <li><a href="blog-left-sidebar.html" class="site-nav">Left Sidebar</a></li>
                                        <li><a href="blog-right-sidebar.html" class="site-nav">Right Sidebar</a></li>
                                        <li><a href="blog-fullwidth.html" class="site-nav">Fullwidth</a></li>
                                        <li><a href="blog-grid-view.html" class="site-nav">Gridview</a></li>
                                        <li><a href="blog-article.html" class="site-nav">Article</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <!--End Desktop Menu-->
                    </div>
                    <!--Mobile Logo-->
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                        <div class="logo">
                            <a href="{{ asset('/') }}">
                                <img src="{{ asset('/') }}client/images/logo.svg"
                                    alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                            </a>
                        </div>
                    </div>
                    <!--Mobile Logo-->
                    <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                        <div class="site-cart">
                            <a href="{{ route('cart.index') }}" class="site-header__cart" title="Cart">
                                <i class="icon anm anm-bag-l"></i>
                                <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">
                                    {{-- đếm cart --}}
                                    @php
                                        if (\Auth::check()) {
                                            $user = \Auth::user();
                                            $cartItems = \DB::table('carts')->select(['id'])->where('user_id', $user->id)->get();
                                            $cartCount = $cartItems->count();
                                        } else {
                                            $cartCount = session()->has('cart') ? count(session()->get('cart')) : 0;
                                        }
                                    @endphp
                                    {{ $cartCount }}
                                </span>
                            </a>
                        </div>
                        <div class="site-header__search">
                            <button type="button" class="search-trigger"><i
                                    class="icon anm anm-search-l"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header-->

        <!--Mobile Menu-->
        <div class="mobile-nav-wrapper" role="navigation">
            <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>
            <ul id="MobileNav" class="mobile-nav">
                <li class="lvl1 parent megamenu"><a href="index.html">Home <i class="anm anm-plus-l"></i></a>
                    <ul>
                        <li><a href="#" class="site-nav">Home Group 1<i class="anm anm-plus-l"></i></a>
                        </li>
                    </ul>
                </li>
                <li class="lvl1 parent megamenu"><a href="#">Shop <i class="anm anm-plus-l"></i></a>
                    <ul>

                        <li><a href="#" class="site-nav">Shop Features<i class="anm anm-plus-l"></i></a>
                            <ul>
                                <li><a href="shop-left-sidebar.html" class="site-nav">Product Countdown </a></li>
                                <li><a href="shop-right-sidebar.html" class="site-nav">Infinite Scrolling</a></li>
                                <li><a href="shop-grid-3.html" class="site-nav">Pagination - Classic</a></li>
                                <li><a href="shop-grid-6.html" class="site-nav">Pagination - Load More</a></li>
                                <li><a href="product-labels.html" class="site-nav">Dynamic Product Labels</a></li>
                                <li><a href="product-swatches-style.html" class="site-nav">Product Swatches </a></li>
                                <li><a href="product-hover-info.html" class="site-nav">Product Hover Info</a></li>
                                <li><a href="shop-grid-3.html" class="site-nav">Product Reviews</a></li>
                                <li><a href="shop-left-sidebar.html" class="site-nav last">Discount Label </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="lvl1 parent megamenu"><a href="product-layout-1.html">Product <i
                            class="anm anm-plus-l"></i></a>
                    <ul>
                        <li><a href="product-layout-1.html" class="site-nav">Product Page<i
                                    class="anm anm-plus-l"></i></a>
                            <ul>
                                <li><a href="product-layout-1.html" class="site-nav">Product Layout 1</a></li>
                                <li><a href="product-layout-2.html" class="site-nav">Product Layout 2</a></li>
                                <li><a href="product-layout-3.html" class="site-nav">Product Layout 3</a></li>
                                <li><a href="product-with-left-thumbs.html" class="site-nav">Product With Left
                                        Thumbs</a></li>
                                <li><a href="product-with-right-thumbs.html" class="site-nav">Product With Right
                                        Thumbs</a></li>
                                <li><a href="product-with-bottom-thumbs.html" class="site-nav last">Product With
                                        Bottom Thumbs</a></li>
                            </ul>
                        </li>
                        <li><a href="short-description.html" class="site-nav">Product Features<i
                                    class="anm anm-plus-l"></i></a>
                            <ul>
                                <li><a href="short-description.html" class="site-nav">Short Description</a></li>
                                <li><a href="product-countdown.html" class="site-nav">Product Countdown</a></li>
                                <li><a href="product-video.html" class="site-nav">Product Video</a></li>
                                <li><a href="product-quantity-message.html" class="site-nav">Product Quantity
                                        Message</a></li>
                                <li><a href="product-visitor-sold-count.html" class="site-nav">Product Visitor/Sold
                                        Count </a></li>
                                <li><a href="product-zoom-lightbox.html" class="site-nav last">Product Zoom/Lightbox
                                    </a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="site-nav">Product Features<i class="anm anm-plus-l"></i></a>
                            <ul>
                                <li><a href="product-with-variant-image.html" class="site-nav">Product with Variant
                                        Image</a></li>
                                <li><a href="product-with-color-swatch.html" class="site-nav">Product with Color
                                        Swatch</a></li>
                                <li><a href="product-with-image-swatch.html" class="site-nav">Product with Image
                                        Swatch</a></li>
                                <li><a href="product-with-dropdown.html" class="site-nav">Product with Dropdown</a>
                                </li>
                                <li><a href="product-with-rounded-square.html" class="site-nav">Product with Rounded
                                        Square</a></li>
                                <li><a href="swatches-style.html" class="site-nav last">Product Swatches All Style</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#" class="site-nav">Product Features<i class="anm anm-plus-l"></i></a>
                            <ul>
                                <li><a href="product-accordion.html" class="site-nav">Product Accordion</a></li>
                                <li><a href="product-pre-orders.html" class="site-nav">Product Pre-orders </a></li>
                                <li><a href="product-labels-detail.html" class="site-nav">Product Labels</a></li>
                                <li><a href="product-discount.html" class="site-nav">Product Discount In %</a></li>
                                <li><a href="product-shipping-message.html" class="site-nav">Product Shipping
                                        Message</a></li>
                                <li><a href="product-shipping-message.html" class="site-nav last">Size Guide </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="lvl1 parent megamenu"><a href="about-us.html">Pages <i class="anm anm-plus-l"></i></a>
                    <ul>
                        <li><a href="cart-variant1.html" class="site-nav">Cart Page <i
                                    class="anm anm-plus-l"></i></a>
                            <ul class="dropdown">
                                <li><a href="cart-variant1.html" class="site-nav">Cart Variant1</a></li>
                                <li><a href="cart-variant2.html" class="site-nav">Cart Variant2</a></li>
                            </ul>
                        </li>
                        <li><a href="compare-variant1.html" class="site-nav">Compare Product <i
                                    class="anm anm-plus-l"></i></a>
                            <ul class="dropdown">
                                <li><a href="compare-variant1.html" class="site-nav">Compare Variant1</a></li>
                                <li><a href="compare-variant2.html" class="site-nav">Compare Variant2</a></li>
                            </ul>
                        </li>
                        <li><a href="checkout.html" class="site-nav">Checkout</a></li>
                        <li><a href="about-us.html" class="site-nav">About Us<span
                                    class="lbl nm_label1">New</span></a></li>
                        <li><a href="contact-us.html" class="site-nav">Contact Us</a></li>
                        <li><a href="faqs.html" class="site-nav">FAQs</a></li>
                        <li><a href="lookbook1.html" class="site-nav">Lookbook<i class="anm anm-plus-l"></i></a>
                            <ul>
                                <li><a href="lookbook1.html" class="site-nav">Style 1</a></li>
                                <li><a href="lookbook2.html" class="site-nav last">Style 2</a></li>
                            </ul>
                        </li>
                        <li><a href="404.html" class="site-nav">404</a></li>
                        <li><a href="coming-soon.html" class="site-nav">Coming soon<span
                                    class="lbl nm_label1">New</span></a></li>
                    </ul>
                </li>
                <li class="lvl1 parent megamenu"><a href="blog-left-sidebar.html">Blog <i
                            class="anm anm-plus-l"></i></a>
                    <ul>
                        <li><a href="blog-left-sidebar.html" class="site-nav">Left Sidebar</a></li>
                        <li><a href="blog-right-sidebar.html" class="site-nav">Right Sidebar</a></li>
                        <li><a href="blog-fullwidth.html" class="site-nav">Fullwidth</a></li>
                        <li><a href="blog-grid-view.html" class="site-nav">Gridview</a></li>
                        <li><a href="blog-article.html" class="site-nav">Article</a></li>
                    </ul>
                </li>
                <li class="lvl1"><a href="#"><b>Buy Now!</b></a>
                </li>
            </ul>
        </div>
        <!--End Mobile Menu-->
        <!--End Mobile Menu-->
    </div>
    <!--End Header-->
    @yield('body')
