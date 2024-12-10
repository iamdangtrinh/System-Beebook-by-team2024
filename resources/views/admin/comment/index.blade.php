<title>@yield('title', 'Bình luận')</title>
@extends('layout.admin')

@section('body')
<div class="row wrapper wrapper-content" style="padding: 20px 0 0 !important">
    <form action="" method="get">
        <div class="ibox-content m-b-sm border-bottom">
            <!-- Alert -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <!-- Các bộ lọc -->

            <div class="row justify-content-center">
                <div class="col-6">
                    <form method="GET" action="{{ route('admincomment.index') }}" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>


    <div class="ibox">
        <div class="ibox-content">
            <div class="table-responsive">
                <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                    <thead>
                        <tr>
                            <th>Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Số lượt bình luận</th>
                            <th>Bình luận cũ nhất</th>
                            <th>Bình luận mới nhất</th>
                            <th class="text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($products->isNotEmpty())
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->image_cover ? $product->image_cover : '/no_image.jpg' }}" alt="{{ $product->name }}" width="100">
                            </td>
                            <td>
                                {{ $product->name }}
                                </br>
                                @php
                                $rating = $product->average_rating; // Lấy giá trị rating từ sản phẩm
                                $fullStars = floor($rating); // Số sao đầy
                                $halfStars = ($rating - $fullStars) >= 0.5 ? 1 : 0; // Kiểm tra xem có sao nửa không
                                $emptyStars = 5 - ($fullStars + $halfStars); // Số sao trống
                                @endphp

                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fa fa-star text-warning"></i> <!-- Sao đầy -->
                                    @endfor

                                    @if ($halfStars)
                                    <i class="fa fa-star-half-o text-warning"></i> <!-- Sao nửa -->
                                    @endif

                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="fa fa-star-o"></i> <!-- Sao trống -->
                                        @endfor
                            </td>
                            <td>
                                @if($product->status == 'active')
                                <div class="d-flex justify-content-center">
                                    <div style="width: 10px; height: 10px; background: #00FF00; border-radius: 50%; border: none" class="dot"></div>
                                </div>
                                <!-- <span class="badge badge-info">Đang hoạt động</span> -->
                                @else
                                <div class="d-flex justify-content-center">
                                    <div style="width: 10px; height: 10px; background: red; border-radius: 50%; border: none" class="dot"></div>
                                </div>
                                <!-- <span class="badge">Ngưng hoạt động</span> -->
                                @endif
                            </td>
                            <td class="text-center">{{ $product->comments->count() }}</td>
                            <td>
                                @php
                                $latestComment = $product->comments->sortByDesc('created_at')->first(); // Bình luận mới nhất
                                $oldestComment = $product->comments->sortBy('created_at')->first(); // Bình luận cũ nhất
                                @endphp

                                {{ $oldestComment ? $oldestComment->created_at->format('H:i, d-m-Y') : 'Không có' }}
                            </td>
                            <td>
                                {{ $latestComment ? $latestComment->created_at->format('H:i, d-m-Y') : 'Không có' }}
                            </td>

                            <td>
                                <a href="{{ route('admincomment.show', $product->id) }}" class="btn btn-sm btn-info">Xem chi tiết</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="text-center p-5" colspan="20">
                                <img src="{{ asset('/') }}client/images/ico_emptycart.svg" alt="Không có sách">
                                <h3 class="mt-3">Hiện tại không bình luận</h3>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection