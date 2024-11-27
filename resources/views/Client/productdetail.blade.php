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
                            <div class="zoompro-wrap product-zoom-right pl-20 position-relative">
                                <div class="zoompro-span d-flex justify-content-center">
                                    <img class="blur-up lazyload zoompro"
                                        data-zoom-image="{{ $product->image_cover ? $product->image_cover : '/no_image.jpg' }}"
                                        alt=""
                                        src="{{ $product->image_cover ? $product->image_cover : '/no_image.jpg' }}" style="height: 300px;
                                        width: auto;
                                        object-fit: contain;
                                        object-position: center;" />
                                </div>
                                @if ($product->status == 'inactive'|| $product->quantity <=0)
                                    <div class="status">
                                    @if ($product->status == 'inactive')
                                    <div class="bg-warning text-center p-2">Ngưng hoạt động</div>
                                    @elseif($product->quantity <=0)
                                        <div class="bg-danger text-center text-light p-2">Hết hàng</div>
                                @endif
                             </div>
                        @endif
                        <div class="product-labels">
                            @if ($product->price_sale && $product->is_new)
                            <span class="lbl on-sale">Sale</span>
                            <span class="lbl pr-label1">Mới</span>
                            @elseif ($product->price_sale)
                            <span class="lbl on-sale">Sale</span>
                            @elseif ($product->is_new)
                            <span class="lbl pr-label1">Mới</span>
                            @endif
                        </div>
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
                            <a data-image="{{ $product->image_cover ? $product->image_cover : '/no_image.jpg' }}"
                                data-zoom-image="{{ $product->image_cover ? $product->image_cover : '/no_image.jpg' }}"
                                class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true"
                                tabindex="-1">
                                <img class="blur-up lazyload"
                                    style="height: 60px; object-fit: contain; object-position: center;"
                                    src="{{ $product->image_cover ? $product->image_cover : '/no_image.jpg' }}"
                                    alt="" />
                            </a>
                            @php
                            // Sắp xếp mảng $product_meta theo thứ tự của product_key (hinh1, hinh2, hinh3,...)
                            $sortedMeta = $product_meta->sortBy(function ($meta) {
                            return (int) filter_var(
                            $meta['product_key'],
                            FILTER_SANITIZE_NUMBER_INT,
                            );
                            });
                            @endphp

                            @foreach ($sortedMeta as $meta)
                            @if (strpos($meta['product_key'], 'hinh') === 0)
                            <!-- Kiểm tra nếu product_key bắt đầu bằng 'hinh' -->
                            @php
                            $product_value = trim($meta['product_value']); // Khai báo và gán giá trị cho $product_value
                            @endphp
                            <a data-image="{{ $product_value }}" data-zoom-image="{{ $product_value }}"
                                class="slick-slide slick-cloned" data-slick-index="-3"
                                aria-hidden="true" tabindex="-1">
                                <img class="blur-up lazyload"
                                    style="height: 60px; object-fit: cover; object-position: center;"
                                    src="{{ $product_value }}" alt="Product Image" />
                            </a>
                            @endif
                            @endforeach

                        </div>
                    </div>
                    <div class="lightboximages">
                        <a href="{{ $product->image_cover ? $product->image_cover : '/no_image.jpg' }}"
                            data-size="1462x2048"></a>
                        @foreach ($sortedMeta as $meta)
                        @if (strpos($meta['product_key'], 'hinh') === 0)
                        <!-- Kiểm tra nếu product_key bắt đầu bằng 'hinh' -->
                        @php
                        $product_value = trim($meta['product_value']); // Khai báo và gán giá trị cho $product_value
                        @endphp
                        <a href="{{ $product_value }}" data-size="1462x2048"></a>
                        @endif
                        @endforeach
                    </div>
                </div>
                <!--Product Feature-->
                <div class="prFeatures">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 feature">
                            <img src="{{ asset('/') }}client/images/icon_truck_v2.webp" alt="Safe Payment"
                                title="Safe Payment" />
                            <div class="details">
                                <h3>Thời gian giao hàng</h3>Giao nhanh và uy tín.
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 feature">
                            <img src="{{ asset('/') }}client/images/icon_transfer_v2.webp" alt="Confidence"
                                title="Confidence" />
                            <div class="details">
                                <h3>Chính sách đổi trả</h3>Đổi trả miễn phí toàn quốc.
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 feature">
                            <img src="{{ asset('/') }}client/images/icon_shop_v2.webp"
                                alt="Worldwide Delivery" title="Worldwide Delivery" />
                            <div class="details">
                                <h3>Chính sách khách sỉ</h3>Ưu đãi số lượng lớn.
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 feature">
                            <img src="{{ asset('/') }}client/images/warranty.png" alt="Hotline"
                                title="Hotline" />
                            <div class="details">
                                <h3>Uy tín và an toàn</h3>An toàn bảo mật thông tin khách hàng.
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
                            @if ($product->status !== 'inactive')
                            @if ($product->quantity > 5)
                            <span class="instock">Còn {{ $product->quantity }} quyển sách</span>
                            @elseif ($product->quantity > 0 && $product->quantity <= 5)
                                <span class="outstock">Còn {{ $product->quantity }} quyển sách</span>
                                @else
                                <span class="outstock">Hết hàng</span>
                                @endif
                                @else
                                <span class="outstock">Ngưng hoạt động</span>
                                @endif
                        </div>
                        <div class="product-sku">Lượt xem: <span
                                class="variant-sku">{{ $product->views }}</span></div>
                        <div class="product-review">
                            <a href="#comments">
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
                        </p>
                        <!-- Product Action -->

                        @if ($product->status === 'active' && $product->quantity > 0)
                        <form action="{{ route('cart.store') }}" method="post">
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
                                    <button type="submit" class="btn btn-addto-cart w-50 w-sm-100" style=""
                                        name="addToCart"><i class="icon anm anm-bag-l"></i> Thêm vào giỏ
                                        hàng</button>
                                </div>
                            </div>
                        </form>
                        @endif
                        <!-- End Product Action -->
                    </div>
                    <div class="display-table shareRow">
                        <div class="display-table-cell medium-up--one-third">
                            <div class="wishlist-btn">
                                @if (!auth()->check())
                                <a class="wishlist" href="{{ route('wishlist.index') }}"
                                    title="Thêm vào yêu thích">
                                    <i class="icon anm anm-heart-l" aria-hidden="true"></i>
                                    <span>Đăng nhập để thêm vào yêu thích</span>
                                </a>
                                @elseif($product->isFavoritedByUser())
                                <a class="wishlist add-to-wishlist" href="#"
                                    data-product-id="{{ $product->id }}" title="Thêm vào yêu thích">
                                    <i class="icon anm anm-heart text-danger" aria-hidden="true"></i>
                                    <span>Đã thêm sản phẩm vào yêu thích</span>
                                </a>
                                @else
                                <a class="wishlist add-to-wishlist" href="#"
                                    data-product-id="{{ $product->id }}" title="Thêm vào yêu thích">
                                    <i class="icon anm anm-heart-l" aria-hidden="true"></i>
                                    <span>Thêm vào yêu thích</span>
                                </a>
                                @endif

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
                                    @if ($product->id_manufacturer)
                                    <tr>
                                        <th>Nhà xuất bản</th>
                                        <td><a class="link-danger"
                                                href="{{ asset('nha-xuat-ban/' . $product->manufacturer->slug) }}">{{ $product->manufacturer->name }}</a>
                                        </td>
                                    </tr>
                                    @endif
                                    @if ($product->author)
                                    <tr>
                                        <th>Tác giả</th>
                                        <td><a class="link-danger"
                                                href="{{ asset('tac-gia/' . $product->author->slug) }}">{{ $product->author->name }}</a>
                                        </td>
                                    </tr>
                                    @endif
                                    @if ($product->id_translator)
                                    <tr>
                                        <th>Người dịch</th>
                                        <td>{{ $product->translator->name }}</td>
                                    </tr>
                                    @endif
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
                                    @if ($product->language)
                                    <tr>
                                        <th>Ngôn ngữ</th>
                                        <td>
                                            @if ($product->language == 'tieng-viet')
                                            Tiếng Việt
                                            @elseif ($product->language == 'tieng-anh')
                                            Tiếng Anh
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
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
                                data-src="{{ $pro->image_cover ? $pro->image_cover : '/no_image.jpg' }}"
                                src="{{ $pro->image_cover ? $pro->image_cover : '/no_image.jpg' }}"
                                alt="image" title="product">
                            <!-- End image -->
                        </a>
                        <!-- end product image -->

                        @if ($pro->status !== 'inactive')
                        <form class="variants add add_to_cart" action="{{ route('cart.store') }}"
                            method="post">
                            @csrf
                            <input type="hidden" value="{{ $pro->id }}" name="id_product">
                            <input type="hidden" value="1" name="quantity">
                            <button class="btn btn-addto-cart" type="submit" tabindex="">Thêm giỏ
                                hàng</button>
                        </form>
                        @endif

                        <div class="button-set">
                            <div class="wishlist-btn">
                                @if (!auth()->check())
                                <a class="wishlist" href="{{ route('wishlist.index') }}"
                                    title="Thêm vào yêu thích"><i
                                        class="icon anm anm-heart-l"></i></a>
                                @elseif($pro->isFavoritedByUser())
                                <a class="wishlist add-to-wishlist" href="#"
                                    data-product-id="{{ $pro->id }}"
                                    title="Thêm vào yêu thích"><i
                                        class="icon anm anm-heart text-danger"></i></a>
                                @else
                                <a class="wishlist add-to-wishlist" href="#"
                                    data-product-id="{{ $pro->id }}"
                                    title="Thêm vào yêu thích"><i
                                        class="icon anm anm-heart-l"></i></a>
                                @endif
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
                            <a>
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                    class="font-13 fa {{ $i <= $averageRating ? 'fa-star' : 'fa-star-o' }}"></i>
                                    @endfor
                            </a>
                            <span class="spr-summary-actions-togglereviews">{{ $commentCount }} bình
                                luận</span>
                        </span>
                        <span class="spr-summary-actions">
                            <a href="#comments" class="spr-summary-actions-newreview btn">Viết bình luận</a>
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
<script src="{{ asset('/') }}client/js/vendor/jquery.cookie.js"></script>
<script src="{{ asset('/') }}client/js/vendor/photoswipe.min.js"></script>
<script src="{{ asset('/') }}client/js/vendor/photoswipe-ui-default.min.js"></script>
<script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
<script src="{{ asset('/') }}client/js/customFavorite.js"></script>
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
        <h3>THÔNG TIN CHI TIẾT</h3>
        <table>
            <tbody>
                @if ($product->id_manufacturer)
                <tr>
                    <th>Nhà xuất bản</th>
                    <td><a class="link-danger"
                            href="{{ asset('nha-xuat-ban/' . $product->manufacturer->slug) }}">{{ $product->manufacturer->name }}</a>
                    </td>
                </tr>
                @endif
                @if ($product->author)
                <tr>
                    <th>Tác giả</th>
                    <td><a class="link-danger"
                            href="{{ asset('tac-gia/' . $product->author->slug) }}">{{ $product->author->name }}</a>
                    </td>
                </tr>
                @endif
                @if ($product->id_translator)
                <tr>
                    <th>Người dịch</th>
                    <td>{{ $product->translator->name }}</td>
                </tr>
                @endif
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
                @if ($product->language)
                <tr>
                    <th>Ngôn ngữ</th>
                    <td>
                        @if ($product->language == 'tieng-viet')
                        Tiếng Việt
                        @elseif ($product->language == 'tieng-anh')
                        Tiếng Anh
                        @endif
                    </td>
                </tr>
                @endif
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
@endsection