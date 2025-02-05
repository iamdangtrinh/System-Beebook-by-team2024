<title>@yield('title', 'Trang chủ')</title>
@extends('layout.client')
@section('body')
    <!--Body Content-->
    <div id="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-sm-12">
                    <form class="d-flex gap-1 m-0 position-relative" method="GET" action="{{ route('search') }}">
                        <div class="w-75 flex-fill">
                            <input class="rounded" type="text" id="search" name="query"
                                placeholder="Tìm kiếm sách, tác giả, nhà xuất bản, bài viết" autocomplete="off">
                        </div>
                        <button class="btn btn-primary" name="seach" type="submit"><i class="icon anm anm-search-l"></i></button>
                        <div id="search-results" class="search-results p-3 row" style="display: none;">
                            <!-- Kết quả tìm kiếm sẽ hiển thị ở đây -->
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!--Image Banners-->
        <div class="imgBnrOuter">
            <div class="container">
                {{-- banner --}}
                <div class="row g-2">
                    <div class="col-xl-8 col-md-12 col-12">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($bannerMain as $item)
                                    <div class="swiper-slide">
                                        <a href="{{ $item->text_link }}">
                                            <img src="{{ $item->image }}" alt="{{ $item->image }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    {{-- banner  --}}
                    <div class="col-xl-4 d-md-none d-sm-none d-none d-xl-block col-md-12 col-12">
                        <div class="bannerLeft">
                            <div>
                                <img src="{{ $bannerSecondary[0]['image'] ?? '/no_image.jpg' }}" alt="banner 2">
                            </div>
                            <div>
                                <img src="{{ $bannerSecondary[1]['image'] ?? '/no_image.jpg' }}" alt="banner 3">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper categorySlide">
                    <h3 class="titleCategory">Danh mục sản phẩm</h3>
                    <div class="swiper-wrapper">
                        @foreach ($categories as $category)
                            <div class="swiper-slide">
                                <a style="display: flex; flex-direction: column;gap: 10px"
                                    href="{{ asset('danh-muc/' . $category->slug) }}">
                                    <div class="category-box">
                                        <img style="width: 100%;height: 100%;"
                                            src="{{ asset('storage/uploads/' . ($category->image === '' ? 'no_image.jpg' : $category->image)) }}"
                                            alt="">
                                    </div>
                                    <span> {{ $category->name }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <div class="container section pt-0">
            {{-- <div class="flashSale mb-3"> --}}
            <div class="productList">
                <div class="border rounded mb-3 pt-3"
                    style="background: url('/client/images/flash_sale_background_image.webp') no-repeat center center; background-size: cover;">
                    <div class="container">
                        <div class="title-custom bg-white rounded my-3">
                            <div class="row align-items-center px-3">
                                <h2 class="col-md-8 col-sm-12 p-3 m-0"><strong>SẢN PHẨM NỔI BẬT</strong></h2>
                                <a class="col-md-4 col-sm-12 text-md-end text-start link-danger" href="{{ route('product.hot') }}">Xem tất cả >></a>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 rounded">
                                <div class="grid-products py-3 mb-3">
                                    <div class="row">
                                        @foreach ($hotProducts as $product)
                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                                <div class="bg-light rounded">
                                                    <div class="product-image">
                                                        <a href="{{ asset('san-pham/' . $product->slug) }}"
                                                            class="grid-view-item__link">
                                                            <img class="primary lazyload"
                                                                src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                                alt="{{ $product->name }}">
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
                                                                    <a class="wishlist add-to-wishlist" href="#"
                                                                        data-product-id="{{ $product->id }}"
                                                                        title="Thêm vào yêu thích"><i
                                                                            class="icon anm anm-heart text-danger"></i></a>
                                                                @else
                                                                    <a class="wishlist add-to-wishlist" href="#"
                                                                        data-product-id="{{ $product->id }}"
                                                                        title="Thêm vào yêu thích"><i
                                                                            class="icon anm anm-heart-l"></i></a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-details pb-2">
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
                                                        <!-- End product price -->
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
            {{-- </div> --}}
        </div>

        <!--End Image Banners-->

        <div class="container">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <a href="{{ $thirdBanner[0]->text_link ?? '' }}">
                    <img src="{{ $thirdBanner[0]->image ?? '/no_image.jpg' }}"
                        alt="{{ $thirdBanner[0]->text_link ?? 'image' }}" class="lazyload w-100 rounded object-fit-cover" />
                </a>
            </div>
        </div>

        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="section-header text-center">
                            <h2 class="h2">SẢN PHẨM GIẢM GIÁ</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="grid-products grid--view-items">
                            <div class="row">
                                @foreach ($saleProducts as $product)
                                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                        <div class="product-image">
                                            <a href="{{ asset('san-pham/' . $product->slug) }}"
                                                class="grid-view-item__link">
                                                <img class="primary lazyload"
                                                    src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                    alt="{{ $product->name }}">
                                            </a>

                                            <form class="variants add add_to_cart" action="{{ route('cart.store') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="id_product">
                                                <input type="hidden" value="1" name="quantity">
                                                <button class="btn btn-addto-cart" type="submit" tabindex="">Thêm giỏ
                                                    hàng</button>
                                            </form>
                                            <div class="button-set">
                                                <div class="wishlist-btn">
                                                    @if (!auth()->check())
                                                        <a class="wishlist" href="{{ route('wishlist.index') }}"
                                                            title="Thêm vào yêu thích"><i
                                                                class="icon anm anm-heart-l"></i></a>
                                                    @elseif($product->isFavoritedByUser())
                                                        <a class="wishlist add-to-wishlist" href="#"
                                                            data-product-id="{{ $product->id }}"
                                                            title="Thêm vào yêu thích"><i
                                                                class="icon anm anm-heart text-danger"></i></a>
                                                    @else
                                                        <a class="wishlist add-to-wishlist" href="#"
                                                            data-product-id="{{ $product->id }}"
                                                            title="Thêm vào yêu thích"><i
                                                                class="icon anm anm-heart-l"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-details text-center">
                                            <div class="product-name">
                                                <a
                                                    href="{{ asset('san-pham/' . $product->slug) }}">{{ $product->name }}</a>
                                            </div>
                                            <div class="product-price">
                                                @if (!$product->price_sale)
                                                    <span class="price">{{ number_format($product->price, 0, ',', '.') }}
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hiển thị banner --}}
        <div class="section">
            <div class="container text-center">
                <a href="{{ $thirdBanner[1]->text_link ?? '' }}">
                    <img src="{{ $thirdBanner[1]->image ?? '/no_image.jpg' }}"
                        alt="{{ $thirdBanner[1]->text_link ?? 'image' }}" class="lazyload w-100 rounded object-fit-cover" />
                </a>
            </div>
        </div>

        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="section-header text-center">
                            <h2 class="h2">BÀI VIẾT GẦN ĐÂY</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-sm-12 col-md-12 col-lg-3 item">
                            <a class="article_featured-image" aria-label="{{ $blog['title'] }}" href="/posts/{{ $blog['slug'] }}"><img
                                    class="blur-up lazyload"
                                    src={{ asset($blog['image'] ? $blog['image'] : 'no_image.jpg') }}
                                    alt="It's all about how you wear"></a>
                            <h2 class="h3"><a href="/posts/{{ $blog['slug'] }}">{{ $blog['title'] }}</a></h2>
                            <p>{{ $blog['tags'] }}</p>
                            <ul class="publish-detail">
                                <li><i class="anm anm-eye" aria-hidden="true"></i>{{ $blog['views'] }}</li>
                                <li><i class="icon anm anm-clock-r"></i>
                                    <time
                                        datetime="{{ \Carbon\Carbon::parse($blog['updated_at'])->format('Y-m-d\TH:i:s') }}">
                                        {{ \Carbon\Carbon::parse($blog['updated_at'])->format('  H:i d/m/Y') }}
                                    </time>
                                </li>
                            </ul>
                            <p><a href="/posts/{{ $blog['slug'] }}"></a></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="section home-lookbook">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center text-dark">
                        <p class="mb-4">Để có thể xem được đa dạng sách hơn, nhấp ngay vào cửa hàng để có thể tìm thêm
                            nhiều quyển sách hay nữa nhé!</p>
                        <a class="btn" href="{{ asset('/') }}cua-hang">Ghé thăm cửa hàng</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- giao hanfg --}}
        <div class="section store-information">
            <div class="container">
                <div class="row">
                    <ul class="display-table store-info">
                        <li class="display-table-cell"> <i class="anm anm-truck-l" aria-hidden="true"></i>
                            <h5>Thời gian giao hàng</h5>
                            <span class="sub-text">
                                Phối hợp với đơn vị giao nhanh và uy tín
                            </span>
                        </li>
                        <li class="display-table-cell"> <i class="anm anm-phone-l" aria-hidden="true"></i>
                            <h5>Hỗ trợ khách hàng</h5>
                            <span class="sub-text">
                                Đợi tin nhắn từ khách hàng 24/24
                            </span>
                        </li>
                        <li class="display-table-cell"> <i class="anm anm-money-bill-ar" aria-hidden="true"></i>
                            <h5>Hoàn tiền</h5>
                            <span class="sub-text">
                                Bảo hành hoàn tiền trong vòng 7 ngày
                            </span>
                        </li>
                        <li class="display-table-cell"> <i class="anm anm-gift-l" aria-hidden="true"></i>
                            <h5>Giảm giá cho thành viên</h5>
                            <span class="sub-text">
                                Mã giảm giá hấp dẫn cho thành viên
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <style>
        .category-box {
            width: 140px;
            height: 140px;
        }

        /* Kiểu cho màn hình nhỏ hơn 768px (mobile) */
        @media (max-width: 768px) {
            .category-box {
                width: 80px;
                height: 80px;
            }
        }
    </style>
    <script>
        jQuery(document).ready(function() {
            jQuery('.closepopup').on('click', function() {
                jQuery('#popup-container').fadeOut();
                jQuery('#modalOverly').fadeOut();
            });
        });

        jQuery(document).mouseup(function(e) {
            var container = jQuery('#popup-container');
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.fadeOut();
                jQuery('#modalOverly').fadeIn(200);
                jQuery('#modalOverly').hide();
            }
        });

        // banner
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            autoplay: {
                delay: 2500
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        // category
        var swiper = new Swiper(".categorySlide", {
            slidesPerView: 4,
            spaceBetween: 10,
            autoplay: {
                delay: 1500
            },
            breakpoints: {
                400: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 6,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 8,
                    spaceBetween: 20,
                },
            },
        });
    </script>
    <script src="{{ asset('/') }}client/js/customFavorite.js"></script>
    <script src="{{ asset('/') }}client/js/customSearch.js"></script>
    <script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
@endsection
