<title>@yield('title', 'Cửa hàng')</title>
@extends('layout.client')
@section('body')
<div id="page-content">
    <!--Collection Banner-->
    <!-- <div class="collection-header">
        <div class="collection-hero">
            <div class="collection-hero__image"><img class="blur-up lazyload" data-src="assets/images/cat-women.jpg" src="assets/images/cat-women.jpg" alt="Women" title="Women" /></div>
            <div class="collection-hero__title-wrapper">
                <h1 class="collection-hero__title page-width">Shop Left Sidebar</h1>
            </div>
        </div>
    </div> -->
    <!--End Collection Banner-->

    <h1 class="text-center mt-3">
        {{ isset($category) ? 'Danh mục: ' . $category->name : 'Cửa hàng' }}
    </h1>
    <div class="container mt-3">
        <div class="row">
            <!--Sidebar-->
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
                <div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
                <div class="sidebar_tags">
                    <!--Categories-->
                    <div class="sidebar_widget categories filter-widget">
                        <div class="widget-title">
                            <h2>Danh mục</h2>
                        </div>
                        <div class="widget-content">
                            <ul class="sidebar_categories">
                                @foreach ($categories as $category)
                                @if ($category->children->count() > 0)
                                <li class="level1 sub-level">
                                    <a class="site-nav"><a href="{{ asset('danh-muc/' . $category->slug) }}">{{ $category->name }}</a></a>
                                    <ul class="sublinks">
                                        @foreach ($category->children as $child)
                                        <li class="level2">
                                            <a href="{{ asset('danh-muc/' . $category->slug) }}" class="site-nav">{{ $child->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                                <li class="lvl-1"><a href="{{ asset('danh-muc/' . $category->slug) }}" class="site-nav">{{ $category->name }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--Categories-->
                    <!--Price Filter-->
                    <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title">
                            <h2>Giá</h2>
                        </div>
                        <form action="#" method="post" class="price-filter">
                            <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="no-margin"><input id="amount" type="text"></p>
                                </div>
                                <div class="col-6 text-right margin-25px-top">
                                    <button class="btn btn-secondary btn--small">Lọc</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--End Price Filter-->
                    <!--Brand-->
                    <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title">
                            <h2>Ngôn ngữ</h2>
                        </div>
                        <ul>
                            <li>
                                <input type="checkbox" value="allen-vela" id="check1">
                                <label for="check1"><span><span></span></span>Tiếng Việt</label>
                            </li>
                            <li>
                                <input type="checkbox" value="oxymat" id="check3">
                                <label for="check3"><span><span></span></span>Tiếng Anh</label>
                            </li>
                            <li>
                                <input type="checkbox" value="vanelas" id="check4">
                                <label for="check4"><span><span></span></span>Tiếng Trung</label>
                            </li>
                        </ul>
                    </div>
                    <!--End Brand-->
                    <!--Popular Products-->
                    <div class="sidebar_widget">
                        <div class="widget-title">
                            <h2>Sản phẩm HOT</h2>
                        </div>
                        <div class="widget-content">
                            <div class="list list-sidebar-products">
                                <div class="grid">
                                    @foreach ($hotProducts as $product)
                                    <div class="grid__item">
                                        <div class="mini-list-item">
                                            <div class="mini-view_image">
                                                <a class="grid-view-item__link" href="{{ asset('san-pham/' . $product->slug) }}">
                                                    <img class="grid-view-item__image" src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="details"> <a class="grid-view-item__title" href="{{ asset('san-pham/' . $product->slug) }}"><strong>{{$product->name}}</strong></a>
                                                <div class="grid-view-item__meta">
                                                    <div class="product-price">
                                                        @if (!$product->price_sale)
                                                        <span class="price">{{ number_format($product->price, 0, ',', '.') }}
                                                            đ</span>
                                                        @else
                                                        <span class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                                            đ</span>
                                                        <span
                                                            class="price">{{ number_format($product->price_sale, 0, ',', '.') }}
                                                            đ</span>
                                                        @endif
                                                        <!-- <span class="product-price__price"><span class="money">$173.60</span></span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Popular Products-->
                </div>
            </div>
            <!--End Sidebar-->
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <div class="productList product-load-more">
                    <!--Toolbar-->
                    <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Lọc sản phẩm</button>
                    <div class="toolbar">
                        <div class="filters-toolbar-wrapper">
                            <div class="row">
                                <div class="col-8 col-md-8 col-lg-8 filters-toolbar__item filters-toolbar__item--count">
                                    <span class="filters-toolbar__product-count">Hiển thị: {{$totalProducts}} quyển sách</span>
                                </div>
                                <div class="col-4 col-md-4 col-lg-4 text-right">
                                    <div class="filters-toolbar__item">
                                        <label for="SortBy" class="hidden">Lọc</label>
                                        <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort">
                                            <option value="title-ascending" selected="selected">Lọc</option>
                                            <option>Bán chạy</option>
                                            <option>Mới nhất</option>
                                            <option>Cũ nhất</option>
                                            <option>Giá cao tới thấp</option>
                                            <option>Giá thấp tới cao</option>
                                        </select>
                                        <input class="collection-header__default-sort" type="hidden" value="manual">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--End Toolbar-->
                    <div class="grid-products grid--view-items">
                        <div class="row">
                            @if ($products && $products->count() > 0)
                            @foreach ($products as $product)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="{{ asset('san-pham/' . $product->slug) }}" class="grid-view-item__link">
                                        <!-- image -->
                                        <img class="primary lazyload" data-src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                            src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}" alt="image"
                                            title="product">
                                        <!-- End image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Thêm vào giỏ
                                            hàng</button>
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
                                        <a href="{{ asset('san-pham/' . $product->slug) }}">{{ $product->name }}</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        @if (!$product->price_sale)
                                        <span class="price">{{ number_format($product->price, 0, ',', '.') }}
                                            đ</span>
                                        @else
                                        <span class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                            đ</span>
                                        <span
                                            class="price">{{ number_format($product->price_sale, 0, ',', '.') }}
                                            đ</span>
                                        @endif
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->
                            </div>
                            @endforeach
                            @else
                            Chưa có sản phẩm. Chúng tôi sẽ cố gắng cập nhật trong thời gian sớm nhất!
                            @endif
                        </div>
                    </div>
                    <div class="infinitpaginOuter">
                        <div class="infinitpagin">
                            <a href="#" class="btn loadMore">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <!--End Main Content-->
            </div>
        </div>
    </div>
    <script src="{{ asset('/') }}client/js/vendor/jquery.cookie.js"></script>
    @endsection