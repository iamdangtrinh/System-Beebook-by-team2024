<title>@yield('title', 'Chi tiết bài viết')</title>
@extends('layout.client')
@section('body')

    <div id="page-content">
        <!--Page Title-->
        <div class="page section-header text-center mb-0">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-width">{{ $getPost['title'] }}</h1>
                </div>
            </div>
        </div>
        <!--End Page Title-->

        <div class="container mt-5">
            <div class="row">
                <!--Main Content-->
                <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                    <div class="blog--list-view">
                        <div class="article">
                            <a class="article_featured-image" href="#"><img class="blur-up lazyload h-100"
                                    src="{{ asset($getPost['image'] ? $getPost['image'] : 'no_image.jpg') }}"
                                    alt="{{ $getPost['title'] }}"></a>
                            <h1><a href="blog-left-sidebar.html">{{ $getPost['title'] }}</a></h1>
                            <ul class="publish-detail">

                                <li>{{ $getPost['post_type'] }}</li>
                                <li><i class="anm anm-eye" aria-hidden="true"></i>{{ $getPost['views'] }}</li>

                                <li><i class="icon anm anm-clock-r"></i> <time
                                        datetime="{{ date('d-m-Y', strtotime($getPost['updated_at'])) }}">{{ date('d-m-Y', strtotime($getPost['updated_at'])) }}</time>
                                </li>
                            </ul>
                            <div class="rte">
                                <h3>{!! $getPost['content'] !!}</h3>
                            </div>
                            <hr />

                            @if ($getProduct)
                                <div class="grid-products grid--view-items">
                                    <div class="row" id="product-list">
                                        <div class="swiper mySwiper">
                                            <div class="swiper-wrapper">
                                                @foreach ($getProduct as $product)
                                                    <div class="swiper-slide">
                                                        <div class="col-sm-6 col-md-12 col-lg-12 item">
                                                            <div class="product-image">
                                                                <a href="{{ asset('san-pham/' . $product->slug) }}"
                                                                    class="grid-view-item__link">
                                                                    <img class="primary lazyload"
                                                                        data-src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                                        src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                                        alt="image" title="product">
                                                                </a>
                                                                <form class="variants add add_to_cart"
                                                                    action="{{ route('cart.store') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" value="{{ $product->id }}"
                                                                        name="id_product">
                                                                    <input type="hidden" value="1" name="quantity">
                                                                    <button class="btn btn-addto-cart" type="submit"
                                                                        tabindex="">Thêm
                                                                        giỏ hàng</button>
                                                                </form>
                                                                <div class="button-set">
                                                                    <div class="wishlist-btn">
                                                                        @if (!auth()->check())
                                                                            <a class="wishlist"
                                                                                href="{{ route('wishlist.index') }}"
                                                                                title="Thêm vào yêu thích"><i
                                                                                    class="icon anm anm-heart-l"></i></a>
                                                                        @elseif($product->isFavoritedByUser())
                                                                            <a class="wishlist add-to-wishlist"
                                                                                href="#"
                                                                                data-product-id="{{ $product->id }}"
                                                                                title="Thêm vào yêu thích"><i
                                                                                    class="icon anm anm-heart text-danger"></i></a>
                                                                        @else
                                                                            <a class="wishlist add-to-wishlist"
                                                                                href="#"
                                                                                data-product-id="{{ $product->id }}"
                                                                                title="Thêm vào yêu thích"><i
                                                                                    class="icon anm anm-heart-l"></i></a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <!-- end product button -->
                                                            </div>
                                                            <div class="product-details text-center">
                                                                <div class="product-name">
                                                                    <a
                                                                        href="{{ asset('san-pham/' . $product->slug) }}">{{ $product->name }}</a>
                                                                </div>
                                                                <div class="product-price">
                                                                    @if (!$product->price_sale)
                                                                        <span
                                                                            class="price">{{ number_format($product->price, 0, ',', '.') }}
                                                                            đ</span>
                                                                    @else
                                                                        <span
                                                                            class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                                                            đ</span>
                                                                        <span
                                                                            class="price">{{ number_format($product->price_sale, 0, ',', '.') }}
                                                                            đ</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar">
                    <div class="sidebar_tags">
                        <div class="sidebar_widget">
                            <div class="widget-title">
                                <h2>Tin nổi bật</h2>
                            </div>
                            <div class="widget-content">
                                <div class="list list-sidebar-products">
                                    <div class="grid">
                                        @foreach ($getMostPost as $mostpost)
                                            <div class="grid__item">
                                                <div class="mini-list-item">
                                                    <div class="mini-view_image">
                                                        <a class="grid-view-item__link"
                                                            href="/posts/{{ $mostpost->slug }}">
                                                            <img class="grid-view-item__image blur-up lazyload"
                                                                src="{{ asset($mostpost->image ? $mostpost->image : 'no_image.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="details"> <a class="grid-view-item__title"
                                                            href="/posts/{{ $mostpost->slug }}">{{ $mostpost->title }}</a>
                                                        <p>{{ $mostpost->tags }}</p>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="sidebar_widget static-banner">
                            <img src="{{ asset('/') }}client/images/side-banner-2.jpg" alt="">
                        </div> --}}
                        <div class="sidebar_widget">
                            <div class="widget-title">
                                <h2>Tin tức liên quan</h2>
                            </div>
                            <div class="widget-content">
                                <div class="list list-sidebar-products">
                                    <div class="grid">
                                        @foreach ($getPostMore as $postmore)
                                            <div class="grid__item">
                                                <div class="mini-list-item">
                                                    <div class="mini-view_image">
                                                        <a class="grid-view-item__link"
                                                            href="/posts/{{ $postmore->slug }}">
                                                            <img class="grid-view-item__image blur-up lazyload"
                                                                src="{{ asset($postmore['image'] ? $postmore['image'] : 'no_image.jpg') }}"
                                                                alt="{{ $postmore->title }}" />
                                                        </a>
                                                    </div>

                                                    <div class="details"> <a class="grid-view-item__title"
                                                            href="/posts/{{ $postmore->slug }}">{{ $postmore->title }}</a>
                                                        <p>{{ $postmore->tags }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($getProduct)
        <style>
            .swiper-pagination-bullet.swiper-pagination-bullet-active {
                background-color: #CE2626 !important;
            }
        </style>
        <script>
            var swiper = new Swiper(".mySwiper", {
                spaceBetween: 0,
                slidesPerView: 4,
                // autoplay: {
                //     delay: 2500,
                //     disableOnInteraction: false,
                // },
                breakpoints: {
                    400: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 20,
                    },
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        </script>
    @endif
    <script src="{{ asset('/') }}client/js/customFavorite.js"></script>
    <script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
@endsection
