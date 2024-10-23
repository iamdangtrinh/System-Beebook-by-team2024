@extends('layout.client')
@section('body')
<!--Body Content-->
<div id="page-content">
    <!--Image Banners-->
    <div class="imgBnrOuter">
        <div class="container">
            {{-- banner --}}
            <div class="row g-2">
                <div class="col-xl-8 col-md-12 col-12">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="login"><img
                                        src="https://cdn0.fahasa.com/media/magentothem/banner7/Banner2_9_0924_840x320.jpg"
                                        alt=""></a>
                            </div>
                            <div class="swiper-slide">
                                <img src="https://cdn0.fahasa.com/media/magentothem/banner7/MCbooks_KC_Slide_840x320.jpg"
                                    alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="https://cdn0.fahasa.com/media/magentothem/banner7/Resize_TrangDoiTacThang09_SlideBanner_840x320.jpg"
                                    alt="">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-xl-4 d-md-none d-sm-none d-none d-xl-block col-md-12 col-12">
                    <div class="bannerLeft">
                        <div>
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Thang-09-2024/btaskeeT9_392x156.jpg" alt="">
                        </div>
                        <div>
                            <img
                                src="https://cdn0.fahasa.com/media/wysiwyg/Thang-09-2024/VNpayT9_392%20x%20156.png" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper categorySlide">
                <h3 class="titleCategory">Danh mục sản phẩm</h3>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <img src="https://cdn0.fahasa.com/media/wysiwyg/Huyen-KD/vn-11134207-7r98o-ly67tdog94y594-removebg-preview_1.png"
                                alt="">
                            Conan Movie</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="flashSale mb-3">
        <div class="timeSale"></div>
        <div class="productList">
            <div class="container border rounded bg-danger">
                <div class="title-custom bg-white rounded my-3">
                    <div class="d-flex justify-content-between align-items-center px-3">
                        <h2 class="p-3 m-0"><strong>SẢN PHẨM NỔI BẬT</strong></h2>
                        <a class="link-danger">Xem tất cả >></a>
                    </div>
                </div>
                <div class="row bg-light bg-gradient rounded mb-3">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="grid-products">
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-3 item">
                                    <div class="product-image">
                                        <a href="" class="grid-view-item__link">
                                            <img class="primary"
                                                src="{{ asset('/') }}client/images/product-images/home15-product1.jpg"
                                                alt="image">
                                        </a>
                                        <form class="variants add add_to_cart" action="#"
                                            onclick="window.location.href='cart.html'" method="post">
                                            <button class="btn btn-addto-cart" type="button" tabindex="0">Add To
                                                Cart</button>
                                        </form>
                                        <div class="button-set">
                                            <div class="wishlist-btn">
                                                <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                    <i class="icon anm anm-heart-l"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-details text-center">
                                        <div class="product-name">
                                            <a href="product-layout-1.html">Chalkboard Side Table</a>
                                        </div>
                                        <div class="product-price">
                                            <span class="old-price">$500.00</span>
                                            <span class="price">$600.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--End Image Banners-->

    <!--Custom Image Banner-->
    <div class="container">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="#">
                <img src="{{ asset('/') }}client/images/collection/image-banner-home15-5.jpg"
                    alt="Save Big On Popular Designs" title="Save Big On Popular Designs" class="lazyload" />
            </a>
        </div>
    </div>
    <!--Custom Image Banner-->

    <!--Hand-picked Items-->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Hand-picked Items</h2>
                        <p>Furniture should always be comfortable.<br>And always have a piece of art that you made
                            somewhere in the home.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="grid-products">
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="product-layout-1.html" class="grid-view-item__link">
                                        <!-- image -->
                                        <img class="primary lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product1.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product1.jpg"
                                            alt="image" title="product">
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product1-1.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product1-1.jpg"
                                            alt="image" title="product">
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Add To
                                            Cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View"
                                            class="quick-view-popup quick-view" data-toggle="modal"
                                            data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html"
                                                title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
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
                                        <a href="product-layout-1.html">Chalkboard Side Table</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="old-price">$500.00</span>
                                        <span class="price">$600.00</span>
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="product-layout-1.html" class="grid-view-item__link">
                                        <!-- image -->
                                        <img class="primary lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product1-1.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product1-1.jpg"
                                            alt="image" title="product">
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product2-1.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product2-1.jpg"
                                            alt="image" title="product">
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Select
                                            Options</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View"
                                            class="quick-view-popup quick-view" data-toggle="modal"
                                            data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html"
                                                title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
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
                                        <a href="product-layout-1.html">Table Small</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$748.00</span>
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="product-layout-1.html" class="grid-view-item__link">
                                        <!-- image -->
                                        <img class="primary lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product3.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product3.jpg"
                                            alt="image" title="product">
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product1-2.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product1-2.jpg"
                                            alt="image" title="product">
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Add To
                                            Cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View"
                                            class="quick-view-popup quick-view" data-toggle="modal"
                                            data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html"
                                                title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
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
                                        <a href="product-layout-1.html">Lounge Chair</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$550.00</span>
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="product-layout-1.html" class="grid-view-item__link">
                                        <!-- image -->
                                        <img class="primary lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product4.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product4.jpg"
                                            alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product4-1.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product4-1.jpg"
                                            alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Add To
                                            Cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View"
                                            class="quick-view-popup quick-view" data-toggle="modal"
                                            data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html"
                                                title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
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
                                        <a href="product-layout-1.html">Wall Clock</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="old-price">$900.00</span>
                                        <span class="price">$788.00</span>
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                <!-- start product image -->
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="product-layout-1.html" class="grid-view-item__link">
                                        <!-- image -->
                                        <img class="primary lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product2-1.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product2-1.jpg"
                                            alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product1-2.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product1-2.jpg"
                                            alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Select
                                            Options</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View"
                                            class="quick-view-popup quick-view" data-toggle="modal"
                                            data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html"
                                                title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
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
                                        <a href="product-layout-1.html">Rochelle Lounge Chair</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$550.00</span>
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                <div class="product-image">
                                    <!--start product image -->
                                    <a href="product-layout-1.html" class="grid-view-item__link">
                                        <!-- image -->
                                        <img class="primary lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product5.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product5.jpg"
                                            alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product5-1.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product5-1.jpg"
                                            alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->
                                    <!-- product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Add To
                                            Cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View"
                                            class="quick-view-popup quick-view" data-toggle="modal"
                                            data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <!-- Start product button -->
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#"
                                                title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html"
                                                title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End product button -->
                                </div>
                                <!--End start product image -->

                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="product-layout-1.html">Pendent Hanging Ceiling Lamp</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$348.60</span>
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->
                            </div>
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="product-layout-1.html" class="grid-view-item__link">
                                        <!-- image -->
                                        <img class="primary lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product6.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product6.jpg"
                                            alt="image" title="product" />
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product6-1.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product6-1.jpg"
                                            alt="image" title="product" />
                                        <!-- End hover image -->
                                    </a>
                                    <!-- end product image -->
                                    <!-- Start product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Add To
                                            Cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View"
                                            class="quick-view-popup quick-view" data-toggle="modal"
                                            data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#"
                                                title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html"
                                                title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End product button -->
                                </div>
                                <!--End start product image -->
                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="product-layout-1.html">Bottle Set</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$698.00</span>
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->

                            </div>
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                <div class="product-image">
                                    <!-- start product image -->
                                    <a href="product-layout-1.html" class="grid-view-item__link">
                                        <!-- image -->
                                        <img class="primary lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product7.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product7.jpg"
                                            alt="image" title="product">
                                        <!-- End image -->
                                        <!-- Hover image -->
                                        <img class="hover lazyload"
                                            data-src="{{ asset('/') }}client/images/product-images/home15-product7-1.jpg"
                                            src="{{ asset('/') }}client/images/product-images/home15-product7-1.jpg"
                                            alt="image" title="product">
                                        <!-- End hover image -->
                                    </a>
                                    <!-- product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'" method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Add To
                                            Cart</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="javascript:void(0)" title="Quick View"
                                            class="quick-view-popup quick-view" data-toggle="modal"
                                            data-target="#content_quickview">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#"
                                                title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                        <div class="compare-btn">
                                            <a class="compare add-to-compare" href="compare.html"
                                                title="Add to Compare">
                                                <i class="icon anm anm-random-r"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End product button -->
                                </div>
                                <!-- End start product image -->
                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="product-layout-1.html">Hanging Light Dublin</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <span class="price">$748.00</span>
                                    </div>
                                    <!-- End product price -->
                                </div>
                                <!-- End product details -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Hand-picked Items-->

    <!--Home LookBook Section-->
    <div class="section home-lookbook">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 text-center mb-5">
                    <img src="{{ asset('/') }}client/images/collection/home15-lookbook1.jpg" alt=""
                        title="" />
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 text-center mb-5">
                    <img src="{{ asset('/') }}client/images/collection/home15-lookbook2.jpg" alt=""
                        title="" />
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center custom-text">
                    <p class="mb-4">Your home should be a story of who you are, and be a collection of what you love.
                        A table, a chair, a bowl of fruit and a violin; what else does a man need to be happy?</p>
                    <a class="btn" href="#">View Lookbook</a>
                </div>
            </div>
        </div>
    </div>
    <!--End Home LookBook Section-->

    <!--Store Information-->
    <div class="section store-information">
        <div class="container">
            <div class="row">
                <ul class="display-table store-info">
                    <li class="display-table-cell"> <i class="anm anm-truck-l" aria-hidden="true"></i>
                        <h5>Free Shipping</h5>
                        <span class="sub-text">
                            Free shipping on all US order
                        </span>
                    </li>
                    <li class="display-table-cell"> <i class="anm anm-phone-l" aria-hidden="true"></i>
                        <h5>Online Support 24/7</h5>
                        <span class="sub-text">
                            Support online 24 hours a day
                        </span>
                    </li>
                    <li class="display-table-cell"> <i class="anm anm-money-bill-ar" aria-hidden="true"></i>
                        <h5>Money Return</h5>
                        <span class="sub-text">
                            Back guarantee under 7 days
                        </span>
                    </li>
                    <li class="display-table-cell"> <i class="anm anm-gift-l" aria-hidden="true"></i>
                        <h5>Member Discount</h5>
                        <span class="sub-text">
                            On every order over $100.00
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--End Store Information-->
</div>
<!--End Body Content-->

<!--Footer-->

<!--End Footer-->
<!--Scoll Top-->
<span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
<!--End Scoll Top-->

<!-- Newsletter Popup -->
<div class="newsletter-wrap" id="popup-container">
    <div id="popup-window">
        <a class="btn closepopup"><i class="icon icon anm anm-times-l"></i></a>
        <!-- Modal content-->
        <div class="display-table splash-bg">
            <div class="display-table-cell width40"><img src="{{ asset('/') }}client/images/newsletter-img.jpg"
                    alt="Join Our Mailing List" title="Join Our Mailing List" /> </div>
            <div class="display-table-cell width60 text-center">
                <div class="newsletter-left">
                    <h2>Join Our Mailing List</h2>
                    <p>Sign Up for our exclusive email list and be the first to know about new products and special
                        offers</p>
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="email" class="input-group__field newsletter__input" name="EMAIL"
                                value="" placeholder="Email address" required="">
                            <span class="input-group__btn">
                                <button type="submit" class="btn newsletter__submit" name="commit"
                                    id="subscribeBtn"> <span class="newsletter__submit-text--large">Subscribe</span>
                                </button>
                            </span>
                        </div>
                    </form>
                    <ul class="list--inline site-footer__social-icons social-icons">
                        <li><a class="social-icons__link" href="#" title="Facebook"><i
                                    class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="Twitter"><i class="fa fa-twitter"
                                    aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="Pinterest"><i
                                    class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="Instagram"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="YouTube"><i class="fa fa-youtube"
                                    aria-hidden="true"></i></a></li>
                        <li><a class="social-icons__link" href="#" title="Vimeo"><i class="fa fa-vimeo"
                                    aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Newsletter Popup -->



<!--For Newsletter Popup-->
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
@endsection