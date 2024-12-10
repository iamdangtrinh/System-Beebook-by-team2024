<!DOCTYPE html>
<html class="no-js" lang="en">

@php
define('CSS_VER', '1.0.2');
@endphp

<head>
    <title>@yield('title', 'Trang chủ')</title>
    @stack('head')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta name="description"
        content="{{ isset($description_seo) ? $description_seo : 'Beebook hệ thống bán sách chuyên nghiệp, đáp ứng mọi nhu cầu về sách.' }}">
    <meta name="keywords" content="{{ isset($meta_seo) ? $meta_seo : 'sách, sách tiếng Việt, nhà sách' }}">
    
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:url" content="/" />
    <meta name="google-site-verification" content="0NTJDxu20GXY4Pl6OY-u_e1fmLJmV35qAnf380ru9b0" />
    {{-- <meta property="og:type" content="Beebook hệ thống nhà sách chuyên nghiệp. Đáp ứng tất cả các yêu cầu về sách." /> --}}
    <meta property="og:type"
        content="{{ $description ?? 'Beebook hệ thống bán sách chuyên nghiệp. Đáp ứng tất cả các yêu cầu về sách.' }}" />

    <meta property="og:image" content="{{ asset('/') }}client/images/favicon.png" />
    <link rel="shortcut icon" href="{{ asset('/') }}client/images/favicon-beebook.webp" />

    <!-- Tối ưu hóa CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}client/css/plugins.css?ver=@php echo CSS_VER @endphp"
        media="print">
    <link rel="stylesheet" href="{{ asset('/') }}client/css/plugins.css?ver=@php echo CSS_VER @endphp">
    <link rel="stylesheet" href="{{ asset('/') }}client/css/bootstrap.min.css?ver=@php echo CSS_VER @endphp">
    <link rel="stylesheet" href="{{ asset('/') }}client/css/style.css?ver=@php echo CSS_VER @endphp">
    <link rel="stylesheet" href="{{ asset('/') }}client/css/responsive.css?ver=@php echo CSS_VER @endphp">
    <link rel="stylesheet" href="{{ asset('/') }}client/css/custom_css.css?ver=@php echo CSS_VER @endphp">
    <link rel="stylesheet"
        href="{{ asset('/') }}client/js/lib/swiper/swiper-bundle.min.css?ver=@php echo CSS_VER @endphp">
    <link rel="stylesheet" href="{{ asset('/') }}client/js/lib/toastr.css?ver=@php echo CSS_VER @endphp">

    <!-- Hoãn tải JavaScript -->
    <script src="{{ asset('/') }}client/js/jquery.min.js"></script>
    <script src="{{ asset('/') }}client/js/lib/toastr.js?ver=@php echo CSS_VER @endphp" defer></script>
    <script src="{{ asset('/') }}client/js/lib/sweetalert2.js?ver=@php echo CSS_VER @endphp" defer></script>
    <script src="{{ asset('/') }}client/js/lib/swiper/swiper-bundle.min.js?ver=@php echo CSS_VER @endphp"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-N7WWXVQLYT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-N7WWXVQLYT');
    </script>
    <script>
        let loading = `<i class="removeLoading fa fa-spinner fa-spin" style="font-size:18px"></i>`;
    </script>
</head>

<body class="template belle">
    <div class="pageWrapper">
        <div class="header-wrap animated d-flex border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <!--Desktop Logo-->
                    <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                        <a href="{{ asset('/') }}">
                            <img src="{{ asset('/') }}client/images/logo.webp" height="50px" alt="Bee book"
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
                                <li class="lvl1 parent megamenu"><a href="/">Trang chủ<i
                                            class="anm anm-angle-down-l"></i></a></li>
                                @php
                                $categories_header = \App\Models\CategoryProduct::where('parent_id', null)
                                ->where('status', 'active')
                                ->with([
                                'children' => function ($query) {
                                $query->where('status', 'active');
                                },
                                ])
                                ->get();
                                @endphp

                                <li class="lvl1 parent dropdown"><a href="#">Danh mục <i
                                            class="anm anm-angle-down-l"></i></a>
                                    <ul class="dropdown">
                                        @foreach ($result_category as $parentCategory)
                                        @if ($parentCategory->children->isNotEmpty())
                                        <li><a href="{{ url('danh-muc/' . $parentCategory->slug) }}"
                                                class="site-nav">{{ $parentCategory->name }} <i
                                                    class="anm anm-angle-right-l"></i></a>
                                            <ul class="dropdown">
                                                @foreach ($parentCategory->children as $childCategory)
                                                <li><a href="{{ url('danh-muc/' . $childCategory->slug) }}"
                                                        class="site-nav">{{ $childCategory->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="lvl1 parent megamenu"><a href="{{ route('product.index') }}">Cửa hàng</a>
                                </li>
                                <li class="lvl1 parent dropdown"><a href="#">Tin tức - Review sách <i
                                            class="anm anm-angle-down-l"></i></a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('indexBlog') }}" class="site-nav">Bản tin</a></li>
                                        <li><a href="{{ route('indexReview') }}" class="site-nav">Review sách</a></li>
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
                                <img src="{{ asset('/') }}client/images/logo.webp" alt="Bee book"
                                    title="Bee book" />
                            </a>
                        </div>
                    </div>
                    <!--Mobile Logo-->
                    <div class="col-4 col-sm-3 col-md-3 col-lg-2 d-flex align-items-center justify-content-evenly">
                        <div class="col-0 col-sm-0 col-md-0 col-lg-4 " style="width: 20px">
                            <ul id="siteNav" class="d-none d-lg-block"
                                class="site-nav medium center hidearrow d-flex align-items-center justify-content-end">
                                <li class="lvl1 parent dropdown ">
                                    <i style="font-size: 20px" class="icon anm anm-user-circle"></i>
                                    <ul class="dropdown" style="top:30px">
                                        @if (Auth::check())
                                        <li><a href="/profile" class="site-nav">
                                                <i class="icon anm anm-user-circle"></i>
                                                Hồ sơ
                                            </a>
                                        </li>
                                        <li><a href="{{ route('your-order.index') }}" class="site-nav">
                                                <i class="icon anm anm-cart-r"></i>
                                                Đơn hàng của tôi </a>
                                        </li>
                                        <li><a href="{{ asset('/yeu-thich') }}" class="site-nav">
                                                <i class="icon anm anm-heart-r"></i>
                                                Sản phẩm yêu thích </a>
                                        </li>
                                        <li><a href="/logout" class="site-nav">
                                                <i class="icon anm anm-sign-out-ar"></i>
                                                Đăng xuất </a>
                                        </li>
                                        @else
                                        <li><a href="{{ asset('/sign-in') }}" class="site-nav">Đăng nhập </a>
                                        </li>
                                        <li><a href="{{ asset('/sign-up') }}" class="site-nav">Đăng ký </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <div class="site-cart">
                            <a href="{{ asset('/yeu-thich') }}" class="site-header__cart" title="wishlist">
                                <i class="icon anm anm-heart-l"></i>
                            </a>
                        </div>
                        <div class="site-cart">
                            <a href="{{ route('cart.index') }}" class="site-header__cart" title="Cart">
                                <i class="icon anm anm-bag-l"></i>
                                <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">
                                    {{-- đếm cart --}}
                                    @php
                                    if (\Auth::check()) {
                                    $user = \Auth::user();
                                    $cartItems = \DB::table('carts')
                                    ->select(['id'])
                                    ->where('id_user', $user->id)
                                    ->get();
                                    $cartCount = $cartItems->count();
                                    } else {
                                    $cartCount = session()->has('cart') ? count(session()->get('cart')) : 0;
                                    }
                                    @endphp
                                    {{ $cartCount ?? 0 }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header-->

        <!--Mobile Menu-->
        <div class="mobile-nav-wrapper" role="navigation">
            <ul id="MobileNav" class="mobile-nav">
                <li class="lvl1 parent megamenu"><a href="/">Trang chủ<i class="anm anm-angle-down-l"></i></a>
                </li>
                @php
                $categories_header = \App\Models\CategoryProduct::where('parent_id', null)
                ->where('status', 'active')
                ->with([
                'children' => function ($query) {
                $query->where('status', 'active');
                },
                ])
                ->get();
                @endphp

                <li class="lvl1 parent dropdown"><a href="#">Danh mục <i class="anm anm-angle-down-l"></i></a>
                    <ul class="dropdown">
                        @foreach ($result_category as $parentCategory)
                        @if ($parentCategory->children->isNotEmpty())
                        <li><a href="{{ url('danh-muc/' . $parentCategory->slug) }}"
                                class="site-nav">{{ $parentCategory->name }} <i
                                    class="anm anm-angle-right-l"></i></a>
                            <ul class="dropdown">
                                @foreach ($parentCategory->children as $childCategory)
                                <li><a href="{{ url('danh-muc/' . $childCategory->slug) }}"
                                        class="site-nav">{{ $childCategory->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>

                <li class="lvl1 parent megamenu"><a href="{{ route('product.index') }}">Cửa hàng</a>
                </li>
                <li class="lvl1 parent dropdown"><a href="#">Tin tức - Review sách <i
                            class="anm anm-angle-down-l"></i></a>
                    <ul class="dropdown">
                        <li><a href="{{ route('indexBlog') }}" class="site-nav">Bản tin</a></li>
                        <li><a href="{{ route('indexReview') }}" class="site-nav">Review sách</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>