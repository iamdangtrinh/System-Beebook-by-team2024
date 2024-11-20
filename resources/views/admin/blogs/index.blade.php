<title>@yield('title', 'Bài viết')</title>
@extends('layout.admin')

@section('body')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Bài viết</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Trang chủ</a>
            </li>
            <li>
                <i class="fa fa-angle-right mx-1"></i>
            </li>
            <li class="active">
                <strong>Bài viết</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <a href="{{ route('adminblog.add') }}" class="btn btn-outline btn-primary btn-rounded">Thêm bài viết</a>
    </div>
</div>

<div class="row wrapper wrapper-content" style="padding: 20px 0 0 !important">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="title">Tiêu đề</label>
                    <input type="text" id="title" name="title" value="" placeholder="Tiêu đề bài viết"
                        class="form-control">
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="author">Tác giả</label>
                    <input type="text" id="author" name="author" value="" placeholder="Tác giả"
                        class="form-control">
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="status">Trạng thái</label>
                    <select id="status" name="status" class="form-control">
                        <option value="active">Hoạt động</option>
                        <option value="inactive">Ngưng hoạt động</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="date_added">Ngày tạo</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input id="date_added" type="text" class="form-control" value="03/04/2024">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="date_modified">Ngày chỉnh sửa</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input id="date_modified" type="text" class="form-control" value="03/06/2024">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-bordered toggle-arrow-tiny" data-page-size="15">
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th data-hide="image">Ảnh đại diện</th>
                            <th data-hide="title">Tiêu đề</th>
                            <th data-hide="author">Tác giả</th>
                            <th data-hide="category">Danh mục</th>
                            <th data-hide="status">Trạng thái</th>
                            <th class="text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td><img src="{{ $blog->image_cover ? asset($blog->image_cover) : asset('no_image.jpg') }}" width="50px">
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->author }}</td>
                            
                            <td>
                                @if($blog->status == 'active')
                                <span class="badge badge-info">Blog</span>
                                @else
                                <span class="badge">Review</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="btn-group gap-2 w-100 __custom_btn_group">
                                    {{-- <a href="{{ route('adminblog.edit', $blog->id) }}" class="badge text-light text-bg-warning">Sửa</a>
                                    <a href="{{ route('adminblog.delete', $blog->id) }}" class="badge text-light text-bg-danger">Xóa</a> --}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/') }}backend/js/blog/index.js"></script>
@endsection
