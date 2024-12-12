<title>@yield('title', 'Kết quả tìm kiếm')</title>
@extends('layout.client')
@section('body')
<div id="page-content">
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Kết quả tìm kiếm: "{{ $query ?? 'Sản phẩm' }}"</h1>
            </div>
        </div>
    </div>
    @if(!$books->isEmpty())
    <div class="container">
        <h2 class="text-center my-4">Sản phẩm</h2>
        <div class="row product-load-more">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="grid-products grid--view-items">
                    <div class="row">
                        @foreach ($books as $product)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                            <div class="product-image">
                                <a href="{{ asset('san-pham/' . $product->slug) }}"
                                    class="grid-view-item__link">
                                    <img class="primary lazyload"
                                        src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                        alt="{{ $product->name }}">
                                </a>
                                @if ($product->status == 'inactive' || $product->quantity <= 0)
                                    <div class="status">
                                    @if ($product->status == 'inactive')
                                    <div class="bg-warning text-center p-2">Ngưng hoạt động</div>
                                    @elseif($product->quantity <= 0)
                                        <div class="bg-danger text-center text-light p-2">Hết hàng
                            </div>
                            @endif
                        </div>
                        @endif

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
<div class="infinitpaginOuter">
    <div class="infinitpagin">
        <a href="#" class="btn btn-primary loadMore">Xem thêm</a>
    </div>
</div>
</div>
@endif
@if(!$authors->isEmpty())
<div class="container">
    <h2 class="text-center my-4">Tác giả</h2>
    <div class="row">
        @foreach ($authors as $author)
        <div class="col-md-3 col-sm-6 mb-1">
            <a href="/tac-gia/{{$author->slug}}">{{$author->name}}</a>
        </div>
        @endforeach
    </div>
</div>
@endif
@if(!$publishers->isEmpty())
<div class="container">
    <h2 class="text-center my-4">Nhà xuất bản</h2>
    <div class="row">
        @foreach ($publishers as $publisher)
        <div class="col-md-3 col-sm-6 mb-1">
            <a class="my-1 px-1 border border-secondary rounded-pill text-truncate" href="/nha-xuat-ban/{{$publisher->slug}}">{{$publisher->name}}</a>
        </div>
        @endforeach
    </div>
</div>
@endif
@if(!$blogs->isEmpty())
<div class="container">
    <h2 class="text-center my-4">Bài viết</h2>
    <div class="blog--list-view">
        <div class="row">
            @foreach ($blogs as $blog)
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 article">
                <!-- Article Image -->
                <a class="article_featured-image" href="/posts/{{ $blog['slug'] }}"><img
                        class="blur-up lazyload rounded"
                        src="{{ asset($blog->image ? $blog->image : 'no_image.jpg') }}"
                        alt="{{ $blog['title'] }}"></a>
                <h2 class="h3"><a href="/posts/{{ $blog['slug'] }}">{{ $blog['title'] }}</a></h2>
                <p>{{ $blog['tags'] }}</p>
                <ul class="publish-detail">
                    <li><i class="anm anm-eye" aria-hidden="true"></i>{{ $blog['views'] }}</li>
                    <li><i class="icon anm anm-clock-r"></i> <time
                            datetime="{{ date('d-m-Y', strtotime($blog['created_at'])) }}">{{ date('H:i d-m-Y', strtotime($blog['created_at'])) }}</time>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
</div>
<script src="{{ asset('/') }}client/js/customFavorite.js"></script>
<script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
@endsection