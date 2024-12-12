<title>@yield('title', 'Danh sách bài viết đã xóa')</title>
@extends('layout.admin')
@section('body')
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <a href="{{route('adminblog.index')}}" style="width:max-content" class="btn btn-primary mb-3">Quay lại</a>
            @if ($errors->any())
                <ul class="alert nav d-block alert-danger">
                    @foreach ($errors->all() as $error)
                        <li class="">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="row wrapper wrapper-content" style="padding: 10px 0 0 !important">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label class="control-label" for="id">Mã bài viết</label>
                            <input type="text" id="" wire:model.live="id" value=""
                                placeholder="Mã bài viết" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label class="control-label" for="title">Tên bài viết</label>
                            <input type="text" id="title" wire:model.live="title" value=""
                                placeholder="Tên bài viết" class="form-control">
                        </div>
                    </div>
                </div>
                @if (session('deleted_success'))
                    <div class="success text-success">
                        {{ session('deleted_success') }}
                    </div>
                @endif
                @if (session('deleted_error'))
                    <div class="error text-danger">
                        {{ session('deleted_error') }}
                    </div>
                @endif
                @if (session('create_success'))
                    <div class="success text-success">
                        {{ session('create_success') }}
                    </div>
                @endif
                @if (session('create_error'))
                    <div class="error text-danger">
                        {{ session('create_error') }}
                    </div>
                @endif
                @if (session('update_success'))
                    <div class="success text-success">
                        {{ session('update_success') }}
                    </div>
                @endif
                @if (session('update_error'))
                    <div class="error text-danger">
                        {{ session('update_error') }}
                    </div>
                @endif
            </div>

            <div class="ibox">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                            <thead>
                                <tr>
                                    <th>Mã bài viết</th>
                                    <th>Ảnh</th>
                                    <th>Tên bài viết</th>
                                    <th>Slug</th>
                                    <th>Trạng thái</th>
                                    <th>Nổi bật</th>
                                    <th style="width: 200px">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $posts)
                                    <tr>
                                        <td>{{ $posts->id }}</td>
                                        <td>
                                            <img style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid black"
                                                src="{{ asset($posts->image === '' ? 'no_image.jpg' : $posts->image) }}">
                                        </td>
                                        <td>{{ $posts->title }}</td>
                                        <td>{{ $posts->slug }}</td>
                                        <td>{!! $posts->status === 'inactive'
                                            ? '<span class="badge text-bg-danger">Ẩn</span>'
                                            : '<span class="badge text-bg-success">Hiển thị</span>' !!}</td>
                                        <td>{!! $posts->hot === 1 ? '<span class="badge text-bg-success">Có</span>' : 'Không' !!}</td>

                                        <td class="text-right">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('adminblog.restore', ['id' => $posts->id]) }}"
                                                    class="btn btn-sm btn-warning">Khôi phục</a>

                                                <a href="{{ route('adminblog.forceDelete', ['id' => $posts->id]) }}"
                                                    class="btn btn-sm btn-danger">Xóa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                    @if (count($data) === 0)
                        <div class="d-flex flex-column">
                            <img style="height: 200px; object-fit: contain" src='/client/images/manager-user/no-data.webp'
                                alt="">
                            <p class="text-center" style="font-size:1rem ">Không tồn tại bài viết</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <style>
            .pagination .page-item.active .page-link {
                background-color: #F4F4F4 !important;
                /* màu xám */
                border-color: #6c757d !important;
                color: black !important
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </div>
    <script src="{{ asset('/') }}backend/plugins/ckeditor/ckeditor.js"></script>
@endsection
