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
    <h2 class="text-center">Sản phẩm</h2>
    <div class="productList">
        <div class="grid-products grid--view-items">
            <div class="row product-load-more" id="product-list">
                @foreach ($books as $key => $product)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 item" @if($key >= 8) style="display: none;" @endif>
                    <!-- start product image -->
                    <div class="product-image">
                        <a href="{{ asset('san-pham/' . $product->slug) }}" class="grid-view-item__link">
                            <img class="primary lazyload"
                                data-src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                src="{{ asset($product->image_cover ? $product->image_cover : 'no_image.jpg') }}"
                                alt="image" title="product">
                            @if ($product->status == 'inactive'|| $product->quantity <=0)
                            <div class="status">
                                @if ($product->status == 'inactive')
                                <div class="bg-warning text-center p-2">Ngưng hoạt động</div>
                                @elseif($product->quantity <=0)
                                <div class="bg-danger text-center text-light p-2">Hết hàng</div>
                                @endif
                            </div>
                            @endif
                        </a>
                    </div>
                    <div class="product-details text-center">
                        <div class="product-name">
                            <a href="{{ asset('san-pham/' . $product->slug) }}">{{ $product->name }}</a>
                        </div>
                        <div class="product-price">
                            @if (!$product->price_sale)
                            <span class="price">{{ number_format($product->price, 0, ',', '.') }} đ</span>
                            @else
                            <span class="old-price">{{ number_format($product->price, 0, ',', '.') }} đ</span>
                            <span class="price">{{ number_format($product->price_sale, 0, ',', '.') }} đ</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="infinitpaginOuter">
        <div class="infinitpagin">
            <a href="#" class="btn loadMore">Xem thêm</a>
        </div>
    </div>
    @endif

</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    function load_more() {
        // Chọn tất cả các sản phẩm
        const items = document.querySelectorAll(".product-load-more .item");
        let visibleCount = 8; // Ban đầu hiển thị 8 sản phẩm

        // Lắng nghe sự kiện click của nút loadMore
        document.querySelector(".loadMore").addEventListener("click", function (e) {
            e.preventDefault();

            // Hiển thị thêm 8 sản phẩm
            let newVisibleCount = visibleCount + 8;
            for (let i = visibleCount; i < newVisibleCount; i++) {
                if (items[i]) {
                    items[i].style.display = "block";
                }
            }

            // Cập nhật số lượng sản phẩm đã hiển thị
            visibleCount = newVisibleCount;

            // Ẩn nút loadMore nếu đã hiển thị hết sản phẩm
            if (visibleCount >= items.length) {
                this.style.display = "none";
            }
        });
    }

    load_more();
});

</script>
@endsection