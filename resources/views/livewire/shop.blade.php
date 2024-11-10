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
        {{ $title ?? 'Sản phẩm' }}
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
                                            <a href="#" class="site-nav"><a
                                                    href="{{ asset('danh-muc/' . $category->slug) }}">{{ $category->name }}</a></a>
                                            <ul class="sublinks">
                                                @foreach ($category->children as $child)
                                                    <li class="level2">
                                                        <a href="{{ asset('danh-muc/' . $category->slug) }}"
                                                            class="site-nav">{{ $child->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="lvl-1"><a href="{{ asset('danh-muc/' . $category->slug) }}"
                                                class="site-nav">{{ $category->name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--Categories-->
                    <!-- Bộ lọc giá -->
                    {{-- <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title">
                            <h2>Giá</h2>
                        </div>
                        <ul>
                            <li>
                                <input type="checkbox" name="price" value="0-150000" id="price1">
                                <label for="price1"><span><span></span></span>0 đ - 150,000 đ</label>
                            </li>
                            <li>
                                <input type="checkbox" name="price" value="150000-300000" id="price2">
                                <label for="price2"><span><span></span></span>150,000 đ - 300,000 đ</label>
                            </li>
                            <li>
                                <input type="checkbox" name="price" value="300000-500000" id="price3">
                                <label for="price3"><span><span></span></span>300,000 đ - 500,000 đ</label>
                            </li>
                            <li>
                                <input type="checkbox" name="price" value="500000-700000" id="price4">
                                <label for="price4"><span><span></span></span>500,000 đ - 700,000 đ</label>
                            </li>
                            <li>
                                <input type="checkbox" name="price" value="700000" id="price5">
                                <label for="price5"><span><span></span></span>700,000 đ - Trở lên</label>
                            </li>
                        </ul>
                    </div> --}}

                    <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title">
                            <h2>Giá</h2>
                        </div>
                        <ul>
                            <li>
                                <input type="checkbox" wire:click="applyPriceFilter('0-150000')" id="price1"
                                    @if (in_array('0-150000', $priceRange)) checked @endif>
                                <label for="price1"><span><span></span></span>0 đ - 150,000 đ</label>
                            </li>
                            <li>
                                <input type="checkbox" wire:click="applyPriceFilter('150000-300000')" id="price2"
                                    @if (in_array('150000-300000', $priceRange)) checked @endif>
                                <label for="price2"><span><span></span></span>150,000 đ - 300,000 đ</label>
                            </li>
                            <li>
                                <input type="checkbox" wire:click="applyPriceFilter('300000-500000')" id="price3"
                                    @if (in_array('300000-500000', $priceRange)) checked @endif>
                                <label for="price3"><span><span></span></span>300,000 đ - 500,000 đ</label>
                            </li>
                            <li>
                                <input type="checkbox" wire:click="applyPriceFilter('500000-700000')" id="price4"
                                    @if (in_array('500000-700000', $priceRange)) checked @endif>
                                <label for="price4"><span><span></span></span>500,000 đ - 700,000 đ</label>
                            </li>
                            <li>
                                <input type="checkbox" wire:click="applyPriceFilter('700000')" id="price5"
                                    @if (in_array('700000', $priceRange)) checked @endif>
                                <label for="price5"><span><span></span></span>700,000 đ - Trở lên</label>
                            </li>
                        </ul>
                    </div>

                    <!-- Bộ lọc ngôn ngữ -->
                    <div class="sidebar_widget filterBox filter-widget">
                        <div class="widget-title">
                            <h2>Ngôn ngữ</h2>
                        </div>
                        <ul>
                            <li>
                                <input type="checkbox" id="language1" @if (in_array('Tiếng việt', $languages)) checked @endif
                                    wire:click="toggleLanguage('Tiếng việt')">
                                <label for="language1"><span><span></span></span>Tiếng Việt</label>
                            </li>
                            <li>
                                <input type="checkbox" id="language2" @if (in_array('Tiếng anh', $languages)) checked @endif
                                    wire:click="toggleLanguage('Tiếng anh')">
                                <label for="language2"><span><span></span></span>Tiếng Anh</label>
                            </li>
                        </ul>
                    </div>

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
                                                    <a class="grid-view-item__link" aria-label="{{ $product->name }}"
                                                        href="{{ asset('san-pham/' . $product->slug) }}">
                                                        <img class="grid-view-item__image"
                                                            src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                            alt="{{ $product->name }}" />
                                                    </a>
                                                </div>
                                                <div class="details"> <a class="grid-view-item__title"
                                                        href="{{ asset('san-pham/' . $product->slug) }}"><strong>{{ $product->name }}</strong></a>
                                                    <div class="grid-view-item__meta">
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
                <div class="productList">
                    <!--Toolbar-->

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Lọc sản phẩm</button>
                    <div class="toolbar">
                        <div class="filters-toolbar-wrapper">
                            <div class="row">
                                <div class="col-8 col-md-8 col-lg-8 filters-toolbar__item filters-toolbar__item--count">
                                    <span class="filters-toolbar__product-count">Hiển thị: {{ $totalProducts }} quyển
                                        sách</span>
                                </div>
                                <div class="col-4 col-md-4 col-lg-4 text-right">
                                    <div class="filters-toolbar__item">
                                        <label for="SortBy" class="hidden">Lọc</label>
                                        <select name="SortBy" id="SortBy"
                                            class="filters-toolbar__input filters-toolbar__input--sort">
                                            <option value="default" selected="selected">Lọc</option>
                                            <option value="bestseller">Bán chạy</option>
                                            <option value="newest">Mới nhất</option>
                                            <option value="oldest">Cũ nhất</option>
                                            <option value="price-desc">Giá cao tới thấp</option>
                                            <option value="price-asc">Giá thấp tới cao</option>
                                        </select>
                                        <input class="collection-header__default-sort" type="hidden" value="manual">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--End Toolbar-->
                    {{-- <div class="grid-products grid--view-items">
                        <div class="row" id="product-list">
                            @if ($products && $products->count() > 0 && Request::is('yeu-thich'))
                                @foreach ($products as $wishlist)
                                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                        <!-- start product image -->
                                        <div class="product-image">
                                            <!-- start product image -->
                                            <a href="{{ asset('san-pham/' . $wishlist->product->slug) }}"
                                                class="grid-view-item__link">
                                                <!-- image -->
                                                <img class="primary lazyload"
                                                    data-src="{{ asset($wishlist->product->image_cover ? $wishlist->product->image_cover : 'no_image.jpg') }}"
                                                    src="{{ asset($wishlist->product->image_cover ? $wishlist->product->image_cover : 'no_image.jpg') }}"
                                                    alt="image" title="product">
                                                <!-- End image -->
                                            </a>
                                            <!-- end product image -->

                                            <!-- Start product button -->
                                            <form class="variants add add_to_cart" action="{{ route('cart.store') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $wishlist->product->id }}"
                                                    name="id_product">
                                                <input type="hidden" value="1" name="quantity">
                                                <button class="btn btn-addto-cart" type="submit" tabindex="">Thêm
                                                    giỏ hàng</button>
                                            </form>
                                            <div class="button-set">
                                                <div class="wishlist-btn">
                                                    @if (!auth()->check())
                                                        <a class="wishlist" href="{{ route('wishlist.index') }}"
                                                            title="Thêm vào yêu thích"><i
                                                                class="icon anm anm-heart-l"></i></a>
                                                    @elseif($wishlist->product->isFavoritedByUser())
                                                        <a class="wishlist add-to-wishlist" href="#"
                                                            data-product-id="{{ $wishlist->product->id }}"
                                                            title="Thêm vào yêu thích"><i
                                                                class="icon anm anm-heart text-danger"></i></a>
                                                    @else
                                                        <a class="wishlist add-to-wishlist" href="#"
                                                            data-product-id="{{ $wishlist->product->id }}"
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
                                                <a
                                                    href="{{ asset('san-pham/' . $wishlist->product->slug) }}">{{ $wishlist->product->name }}</a>
                                            </div>
                                            <!-- End product name -->
                                            <!-- product price -->
                                            <div class="product-price">
                                                @if (!$wishlist->product->price_sale)
                                                    <span
                                                        class="price">{{ number_format($wishlist->product->price, 0, ',', '.') }}
                                                        đ</span>
                                                @else
                                                    <span
                                                        class="old-price">{{ number_format($wishlist->product->price, 0, ',', '.') }}
                                                        đ</span>
                                                    <span
                                                        class="price">{{ number_format($wishlist->product->price_sale, 0, ',', '.') }}
                                                        đ</span>
                                                @endif
                                            </div>
                                            <!-- End product price -->
                                        </div>
                                        <!-- End product details -->
                                    </div>
                                @endforeach
                            @elseif($products && $products->count() > 0 && !Request::is('yeu-thich'))
                                @foreach ($products as $product)
                                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                        <!-- start product image -->
                                        <div class="product-image">
                                            <!-- start product image -->
                                            <a href="{{ asset('san-pham/' . $product->slug) }}"
                                                class="grid-view-item__link">
                                                <!-- image -->
                                                <img class="primary lazyload"
                                                    data-src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                    src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                    alt="image" title="product">
                                                <!-- End image -->
                                            </a>
                                            <!-- end product image -->

                                            <!-- Start product button -->
                                            <form class="variants add add_to_cart" action="{{ route('cart.store') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="id_product">
                                                <input type="hidden" value="1" name="quantity">
                                                <button class="btn btn-addto-cart" type="submit" tabindex="">Thêm
                                                    giỏ hàng</button>
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
                                            <!-- end product button -->
                                        </div>
                                        <!-- end product image -->
                                        <!--start product details -->
                                        <div class="product-details text-center">
                                            <!-- product name -->
                                            <div class="product-name">
                                                <a
                                                    href="{{ asset('san-pham/' . $product->slug) }}">{{ $product->name }}</a>
                                            </div>
                                            <!-- End product name -->
                                            <!-- product price -->
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
                                        <!-- End product details -->
                                    </div>
                                @endforeach
                            @elseif(!$products && Request::is('yeu-thich'))
                                Chưa có sản phẩm yêu thích. Thêm vào ngay để dễ chọn lựa hơn nào!
                            @else
                                <p>Chưa có sản phẩm. Chúng tôi sẽ cố gắng cập nhật thêm nhiều sách trong tương lai!</p>
                            @endif
                        </div>
                    </div> --}}

                    <div class="grid-products grid--view-items">
                        <div class="row" id="product-list">
                            <!-- Loading Spinner -->
                            <div wire:loading class="col-12 text-center">
                                <div class="loading-spinner">
                                    <span>Đang tải...</span>
                                    <i class="fa fa-spinner fa-spin"></i> <!-- Spinner icon -->
                                </div>
                            </div>

                            <!-- Product List -->
                            @if ($products && $products->count() > 0 && Request::is('yeu-thich'))
                                @foreach ($products as $wishlist)
                                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                        <!-- Product Image -->
                                        <div class="product-image">
                                            <a href="{{ asset('san-pham/' . $wishlist->product->slug) }}"
                                                class="grid-view-item__link">
                                                <img class="primary lazyload"
                                                    data-src="{{ asset($wishlist->product->image_cover ? $wishlist->product->image_cover : 'no_image.jpg') }}"
                                                    src="{{ asset($wishlist->product->image_cover ? $wishlist->product->image_cover : 'no_image.jpg') }}"
                                                    alt="image" title="product">
                                            </a>
                                        </div>

                                        <!-- Add to Cart Form -->
                                        <form class="variants add add_to_cart" action="{{ route('cart.store') }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $wishlist->product->id }}"
                                                name="id_product">
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
                                                @elseif($wishlist->product->isFavoritedByUser())
                                                    <a class="wishlist add-to-wishlist" href="#"
                                                        data-product-id="{{ $wishlist->product->id }}"
                                                        title="Thêm vào yêu thích"><i
                                                            class="icon anm anm-heart text-danger"></i></a>
                                                @else
                                                    <a class="wishlist add-to-wishlist" href="#"
                                                        data-product-id="{{ $wishlist->product->id }}"
                                                        title="Thêm vào yêu thích"><i
                                                            class="icon anm anm-heart-l"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif($products && $products->count() > 0 && !Request::is('yeu-thich'))
                                @foreach ($products as $product)
                                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                        <!-- Product Image -->
                                        <div class="product-image">
                                            <a href="{{ asset('san-pham/' . $product->slug) }}"
                                                class="grid-view-item__link">
                                                <img class="primary lazyload"
                                                    data-src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                    src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                                    alt="image" title="product">
                                            </a>
                                        </div>

                                        <!-- Add to Cart Form -->
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
                                @endforeach
                            @elseif(!$products && Request::is('yeu-thich'))
                                Chưa có sản phẩm yêu thích. Thêm vào ngay để dễ chọn lựa hơn nào!
                            @else
                                <p>Chưa có sản phẩm. Chúng tôi sẽ cố gắng cập nhật thêm nhiều sách trong tương lai!</p>
                            @endif
                        </div>
                    </div>


                </div>
                <!--End Main Content-->
            </div>
            <div class="col-12">
                {{ $products->links() }}
            </div>
        </div>
        {{-- <script src="{{ asset('/') }}client/js/vendor/jquery.cookie.js"></script> --}}
        {{-- <script src="{{ asset('/') }}client/js/customShop.js"></script> --}}
        <script src="{{ asset('/') }}client/js/customFavorite.js"></script>
        <script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
    </div>
</div>
