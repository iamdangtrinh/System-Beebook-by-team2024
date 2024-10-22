<title>@yield('title', 'Chi tiết sách ' . $product->name)</title>
@extends('layout.client')
@section('body')
    <div id="page-content">
        <!--MainContent-->
        <div id="MainContent" class="main-content" role="main">
            <!--Breadcrumb-->
            <div class="bredcrumbWrap">
                <div class="container breadcrumbs">
                    <a href="index.html" title="Back to the home page">Trang chủ</a><span aria-hidden="true">›</span><span>Chi
                        tiết sách {{ $product->name }}</span>
                </div>
            </div>
            <!--End Breadcrumb-->

            <div id="ProductSection-product-template" class="product-template__container prstyle2 container">
                <!--#ProductSection-product-template-->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Thành công!</strong> {{ session('success') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Không thành công!</strong> {{ session('error') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="product-single product-single-1">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="product-details-img product-single__photos bottom">
                                <div class="zoompro-wrap product-zoom-right pl-20">
                                    <div class="zoompro-span">
                                        <img class="blur-up lazyload zoompro"
                                            data-zoom-image="{{ asset('/') . $product->image_cover }}" alt=""
                                            src="{{ asset('/') . $product->image_cover }}" />
                                    </div>
                                    <div class="product-labels"><span class="lbl on-sale">Sale</span><span
                                            class="lbl pr-label1">new</span></div>
                                    <div class="product-buttons">
                                        @if ($product->url_video)
                                            <a href="{{ $product->url_video }}" class="btn popup-video"
                                                title="View Video"><i class="icon anm anm-play-r"
                                                    aria-hidden="true"></i></a>
                                        @endif
                                        <a href="#" class="btn prlightbox" title="Zoom"><i
                                                class="icon anm anm-expand-l-arrows" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="product-thumb product-thumb-1">
                                    <div id="gallery" class="product-dec-slider-1 product-tab-left">
                                        <a data-image="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                            data-zoom-image="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                            class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true"
                                            tabindex="-1">
                                            <img class="blur-up lazyload"
                                                src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                alt="" />
                                        </a>
                                        @foreach ($product_meta as $meta)
                                            @if ($meta['product_key'] == 'thumbnail')
                                                @php
                                                    $product_value = trim($meta['product_value']);

                                                    $product_images = explode(',', $product_value);
                                                @endphp

                                                @foreach ($product_images as $image)
                                                    @php
                                                        $image = trim($image, '" ');
                                                    @endphp

                                                    <a data-image="{{ asset($image) }}"
                                                        data-zoom-image="{{ asset($image) }}"
                                                        class="slick-slide slick-cloned" data-slick-index="-3"
                                                        aria-hidden="true" tabindex="-1">
                                                        <img class="blur-up lazyload" src="{{ asset($image) }}"
                                                            alt="Product Image" />
                                                    </a>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="lightboximages">
                                    <a href="{{ asset('/') . $product->image_cover }}" data-size="1462x2048"></a>
                                    @foreach ($product_meta as $meta)
                                        @if ($meta['product_key'] == 'thumbnail')
                                            @php
                                                $product_value = trim($meta['product_value']);

                                                $product_images = explode(',', $product_value);
                                            @endphp

                                            @foreach ($product_images as $image)
                                                @php
                                                    $image = trim($image, '" ');
                                                @endphp

                                                <a href="{{ asset($image) }}" data-size="1462x2048"></a>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <!--Product Feature-->
                            <div class="prFeatures">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 feature">
                                        <img src="assets/images/credit-card.png" alt="Safe Payment" title="Safe Payment" />
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

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif

                            <div class="product-single__meta">
                                <h1 class="product-single__title">{{ $product->name }}</h1>
                                <div class="product-nav clearfix">
                                    <a href="#" class="next" title="Next"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i></a>
                                </div>
                                <div class="prInfoRow">
                                    <div class="product-stock">
                                        @if ($product->quantity > 5)
                                            <span class="instock">Còn {{ $product->quantity }} quyển sách</span>
                                        @elseif($product->quantity > 0 && $product->quantity <= 5)
                                            <span class="outstock">Còn {{ $product->quantity }} quyển sách</span>
                                        @else
                                            <span class="outstock">Hết hàng</span>
                                        @endif
                                    </div>
                                    <div class="product-sku">Lượt xem: <span
                                            class="variant-sku">{{ $product->views }}</span></div>
                                    <div class="product-review">
                                        <a class="reviewLink">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="font-13 fa {{ $i <= $averageRating ? 'fa-star' : 'fa-star-o' }}"></i>
                                            @endfor
                                        </a>
                                        <span class="spr-summary-actions-togglereviews">{{ $commentCount }} bình
                                            luận</span>
                                    </div>

                                </div>
                                <p class="product-single__price product-single__price-product-template">
                                    @if (!$product->price_sale)
                                        <span
                                            class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                            <span id="ProductPrice-product-template"><span
                                                    class="money">{{ number_format($product->price, 0, ',', '.') }}
                                                    đ</span></span>
                                        </span>
                                    @else
                                        <span class="visually-hidden">Giá gốc</span>
                                        <s id="ComparePrice-product-template"><span
                                                class="money">{{ number_format($product->price, 0, ',', '.') }}
                                                đ</span></s>
                                        <span
                                            class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                            <span id="ProductPrice-product-template"><span
                                                    class="money">{{ number_format($product->price_sale, 0, ',', '.') }}
                                                    đ</span></span>
                                        </span>
                                        <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                                            <span>Tiết kiệm</span>
                                            <span id="SaveAmount-product-template" class="product-single__save-amount">
                                                <span
                                                    class="money">{{ number_format($product->price - $product->price_sale, 0, ',', '.') }}
                                                    đ</span>
                                            </span>
                                            <span
                                                class="off">(<span>{{ round((($product->price - $product->price_sale) / $product->price) * 100) }}</span>%)</span>
                                        </span>
                                    @endif
                                </p>
                                <div>
                                    <p class="infolinks"><a href="#sizechart" class="sizelink btn">Thông tin chi tiết</a>
                                        <a href="#productInquiry" class="emaillink btn">Hỏi về sách</a>
                                    </p>
                                    <!-- Product Action -->
                                    <form action={{ route('cart.store') }} method="post">
                                        <div class="product-action">
                                            <div class="product-form__item--quantity">
                                                <div class="wrapQtyBtn">
                                                    <div class="qtyField">
                                                        <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                                class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                        <input type="text" id="Quantity" name="quantity"
                                                            value="1" class="product-form__input qty">
                                                        <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                                class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-form__item--submit">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="id_product">
                                                <button type="submit" class="btn btn-addto-cart" name="addToCart"><i
                                                        class="icon anm anm-bag-l"></i> Thêm vào giỏ hàng</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End Product Action -->
                                </div>
                                <div class="display-table shareRow">
                                    <div class="display-table-cell medium-up--one-third">
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist"><i
                                                    class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Thêm vào
                                                    yêu thích</span></a>
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
                                                    <th>Tác giả</th>
                                                    <!-- <td>1</td> -->
                                                    <td>{{ $product->author->name }}</td>
                                                </tr>
                                                @foreach ($product_meta as $meta)
                                                    @if ($meta->product_key == 'form')
                                                        <tr>
                                                            <th>Hình thức</th>
                                                            <td>{{ $meta->product_value }}</td>
                                                        </tr>
                                                    @elseif($meta->product_key == 'number_of_pages')
                                                        <tr>
                                                            <th>Số trang</th>
                                                            <td>{{ $meta->product_value }}</td>
                                                        </tr>
                                                    @elseif($meta->product_key == 'size')
                                                        <tr>
                                                            <th>Kích thước bao bì</th>
                                                            <td>{{ $meta->product_value }} cm</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                @if ($product->year)
                                                    <tr>
                                                        <th>Năm XB</th>
                                                        <td>{{ $product->year }}</td>
                                                    </tr>
                                                @endif
                                                @if ($product->weight)
                                                    <tr>
                                                        <th>Trọng lượng (gr)</th>
                                                        <td>{{ $product->weight }}</td>
                                                    </tr>
                                                @endif
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
                    <div class="related-product grid-products mt-3">
                        <header class="section-header">
                            <h2 class="section-header__title text-center h2"><span>Sách tương tự</span></h2>
                            <p class="sub-heading">Có thể bạn quan tâm, dưới đây là các sách tương tự để bạn có thể dễ dàng
                                chọn lựa.</p>
                        </header>
                        <div class="productPageSlider row">
                            @foreach ($product_same as $pro)
                                <div class="col-6 col-sm-6 col-md-3 col-lg-3 item">
                                    <!-- start product image -->
                                    <div class="product-image">
                                        <!-- start product image -->
                                        <a href="{{ asset('san-pham/' . $pro->slug) }}" class="grid-view-item__link">
                                            <!-- image -->
                                            <img class="primary lazyload"
                                                data-src="{{ asset($pro->image_cover ? $pro->image_cover : 'no_image.jpg') }}"
                                                src="{{ asset($pro->image_cover ? $pro->image_cover : 'no_image.jpg') }}"
                                                alt="image" title="product">
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
                                            <a href="{{ asset('san-pham/' . $pro->slug) }}">{{ $pro->name }}</a>
                                        </div>
                                        <!-- End product name -->
                                        <!-- product price -->
                                        <div class="product-price">
                                            @if (!$pro->price_sale)
                                                <span class="price">{{ number_format($pro->price, 0, ',', '.') }}
                                                    đ</span>
                                            @else
                                                <span class="old-price">{{ number_format($pro->price, 0, ',', '.') }}
                                                    đ</span>
                                                <span class="price">{{ number_format($pro->price_sale, 0, ',', '.') }}
                                                    đ</span>
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
                                        <a class="reviewLink">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="font-13 fa {{ $i <= $averageRating ? 'fa-star' : 'fa-star-o' }}"></i>
                                            @endfor
                                        </a>
                                        <span class="spr-summary-actions-togglereviews">{{ $commentCount }} bình
                                            luận</span>
                                    </span>
                                    <span class="spr-summary-actions">
                                        <a href="#" class="spr-summary-actions-newreview btn">Viết bình luận</a>
                                    </span>
                                </div>
                            </div>
                            <div class="spr-content">
                                @livewire('product-comment-form', ['idProduct' => $product->id, 'slugProduct => $product->slug'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Photoswipe Gallery -->
            <script src="{{ asset('/') }}client/js/vendor/photoswipe.min.js"></script>
            <script src="{{ asset('/') }}client/js/vendor/photoswipe-ui-default.min.js"></script>
            <script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
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
            <div style="padding-left: 30px;"><img src="assets/images/size.jpg" alt=""></div>
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
                                <input type="email" id="ContactFormEmail" name="contact[email]" placeholder="Email"
                                    autocapitalize="off" value="" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <input required type="tel" id="ContactFormPhone" name="contact[phone]"
                                    pattern="[0-9\-]*" placeholder="Phone Number" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <textarea required rows="10" id="ContactFormMessage" name="contact[body]" placeholder="Message"></textarea>
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
@endsection
