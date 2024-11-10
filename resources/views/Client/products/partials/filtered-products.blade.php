@if ($products && $products->count() > 0)
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
            <input type="hidden" value="{{$product->id}}" name="id_product">
            <input type="hidden" value="1" name="quantity">
            <button class="btn btn-addto-cart" type="submit" tabindex="">Thêm giỏ hàng</button>
        </form>
        <div class="button-set">
            <div class="wishlist-btn">
                <a class="wishlist add-to-wishlist" href="#">
                    <i class="icon anm anm-heart-l"></i>
                    <!-- <i class="icon anm anm-heart"></i> -->
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
@else
<p>Chưa có sản phẩm. Chúng tôi sẽ cố gắng cập nhật thêm nhiều sách trong tương lai!</p>
@endif
{{-- {{ $products->links('vendor.pagination.custom') }} --}}