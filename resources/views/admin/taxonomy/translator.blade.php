<title>
    @yield('title', 'Đơn hàng')</title>
@extends('layout.admin')

@section('body')
<div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">

        </div>

    </div>

    <div class="row wrapper wrapper-content" style="padding: 10px 0 0 !important">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="id">Mã tác giả</label>
                        <input type="text" id="" wire:model.live="id" value=""
                            placeholder="Mã bài viết" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="form-group">
                        <label class="control-label" for="title">Tên danh mục</label>
                        <input type="text" id="title" wire:model.live="title" value=""
                            placeholder="Tên tác giả" class="form-control">
                    </div>
                </div>
            </div>

        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tác giả</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane"
                    aria-selected="false">Nhà sản xuất</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane"
                    aria-selected="false">Người dịch</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                tabindex="0">
            </div>

            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                tabindex="0">
            </div>
        </div>

        <div class="ibox">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Loại</th>
                                <th>Tên</th>
                                <th>Đường dẫn</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taxonomies as $tax)
                                <tr>
                                    <td>{{ $tax->id }}</td>

                                    <td>
                                        @if ($tax->type === 'author')
                                            Tác giả
                                        @elseif ($tax->type === 'translator')
                                            Người phiên dịch
                                        @elseif ($tax->type === 'manufacturer')
                                            Nhà sản xuất
                                        @else
                                            Không xác định
                                        @endif
                                    </td>
                                    <td>{{ $tax->name }}</td>
                                    <td>{{ $tax->slug }}</td>
                                    <td class="text-right">
                                        <button class="btn btn-warning">Sửa</button>
                                        <button class="btn btn-danger">Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    {{ $taxonomies->links() }}

                </div>
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


</div>
@endsection

