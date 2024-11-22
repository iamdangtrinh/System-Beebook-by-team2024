<title>@yield('title', 'Xem chi tiết bình luận')</title>
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


            <!-- Ảnh và thông tin sản phẩm -->
            <div class="row mb-4 align-items-center">
                <div class="col-3">
                    <img src="{{ $product->image_cover ? $product->image_cover : '/no_image.jpg' }}" alt="{{ $product->name }}" width="100%">
                </div>
                <div class="col-7">
                    <h3>{{ $product->name }}</h3>
                </div>
                <div class="col-2">
                    Số lượt bình luận: <strong>{{ $product->comments->count() }}</strong>
                </div>
            </div>
            <!-- Các bộ lọc -->

            <!-- <div class="row justify-content-center">
                <div class="col-6">
                    <form method="GET" action="{{ route('admincomment.index') }}" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    </form>


    <div class="ibox">
        <div class="ibox-content">
            <div class="table-responsive">
                <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                    <thead>
                        <tr>
                            <th>Người dùng</th>
                            <th>Nội dung bình luận</th>
                            <th>Thời gian</th>
                            <th class="text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comments as $comment)
                        <tr>
                            <td>{{ $comment->user->name ?? 'Ẩn danh' }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <!-- Nút xóa hoặc ẩn bình luận -->
                                <form action="{{ route('admincomment.destroy', $comment->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bình luận này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center p-5" colspan="20">
                                <img src="{{ asset('/') }}client/images/ico_emptycart.svg" alt="Không có sách">
                                <h3 class="mt-3">Hiện tại không có bình luận</h3>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $comments->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection