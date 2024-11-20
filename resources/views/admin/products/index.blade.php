<title>@yield('title', 'Sách')</title>
@extends('layout.admin')

@section('body')
<div class="row wrapper border-bottom white-bg page-heading align-items-center">
    <div class="col-lg-6">
        <h2>Sách</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Trang chủ</a>
            </li>
            <li>
                <i class="fa fa-angle-right mx-1"></i>
            </li>
            <li class="active">
                <strong>Sách</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-4">
                <a href="{{ route('adminproduct.add') }}" class="btn btn-outline btn-success btn-rounded">Thêm sách</a>
            </div>
            <div class="col-5">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-default btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Đã xóa gần đây
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đã xóa gần đây</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th data-hide="image">Ảnh chính</th>
                                <th data-hide="name">Tên sách</th>
                                <th data-hide="category">Danh mục</th>
                                <th data-hide="price">Giá</th>
                                <th data-hide="hot">Sách hot</th>
                                <th data-hide="status">Trạng thái</th>
                                <th class="text-right">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($trashedProducts->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">Không có sản phẩm nào xóa gần đây.</td>
                            </tr>
                            @else
                            @foreach ($trashedProducts as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ $product->image_cover ? asset($product->image_cover) : asset('no_image.jpg') }}" width="50px">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    @if(!$product->price_sale)
                                    <strong class="text-danger">{{ $product->price }} đ</strong>
                                    @else
                                    <strong class="text-danger">{{ $product->price_sale }} đ</strong> <del>{{ $product->price }} đ</del>
                                    @endif
                                </td>
                                <td>
                                    @if($product->hot == 1)
                                    <span class="badge badge-success">Có</span>
                                    @else
                                    <span class="badge">Không</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->status == 'active')
                                    <span class="badge badge-info">Đang hoạt động</span>
                                    @elseif($product->status == 'inactive')
                                    <span class="badge">Ngưng hoạt động</span>
                                    @elseif($product->status == 'draft')
                                    <span class="badge">Bản nháp</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('adminproduct.restore', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục sản phẩm này?');">
                                        @csrf
                                        <button type="submit" class="w-100 btn btn-sm btn-success">Khôi phục</button>
                                    </form>
                                    <form class="mt-2" action="{{ route('adminproduct.forceDelete', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-100 btn btn-sm btn-danger">Xóa vĩnh viễn</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form action="{{ route('adminproduct.forceDeleteAll') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn tất cả sản phẩm?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa tất cả</button>
                </form>
                <form action="{{ route('adminproduct.restoreAll') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục tất cả sản phẩm đã xóa?');">
                    @csrf
                    <button type="submit" class="btn btn-success">Khôi phục tất cả</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row wrapper wrapper-content" style="padding: 20px 0 0 !important">
    <div class="ibox-content m-b-sm border-bottom">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="row">
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="order_id">Order ID</label>
                    <input type="text" id="order_id" name="order_id" value="" placeholder="Order ID"
                        class="form-control">
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="status">Order status</label>
                    <input type="text" id="status" name="status" value="" placeholder="Status"
                        class="form-control">
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="customer">Customer</label>
                    <input type="text" id="customer" name="customer" value="" placeholder="Customer"
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="date_added">Date added</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_added"
                            type="text" class="form-control" value="03/04/2014">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="date_modified">Date modified</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_modified"
                            type="text" class="form-control" value="03/06/2014">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="form-group">
                    <label class="control-label" for="amount">Amount</label>
                    <input type="text" id="amount" name="amount" value="" placeholder="Amount"
                        class="form-control">
                </div>
            </div>
        </div>

    </div>

    <div class="ibox">
        <div class="ibox-content">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1"> Sách</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Bản nháp</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                        <tr>
                                            <th>#id</th>
                                            <th data-hide="image">Ảnh chính</th>
                                            <th data-hide="name">Tên sách</th>
                                            <th data-hide="category">Danh mục</th>
                                            <th data-hide="price">Giá</th>
                                            <th data-hide="hot">Sách hot</th>
                                            <th data-hide="status">Trạng thái</th>
                                            <th class="text-right">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($products->isNotEmpty())
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td><img src="{{ $product->image_cover ? asset($product->image_cover) : asset('no_image.jpg') }}" width="50px">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                @if(!$product->price_sale)
                                                <strong class="text-danger">{{ $product->price }} đ</strong>
                                                @else
                                                <strong class="text-danger">{{ $product->price_sale }} đ</strong> <del>{{ $product->price }} đ</del>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->hot == 1)
                                                <span class="badge badge-success">Có</span>
                                                @else
                                                <span class="badge">Không</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($product->status == 'active')
                                                <span class="badge badge-info">Đang hoạt động</span>
                                                @else
                                                <span class="badge">Ngưng hoạt động</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group gap-2 w-100 __custom_btn_group">
                                                    <a href="{{ route('adminproduct.edit', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                                                    <form class="m-0" action="{{ route('adminproduct.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center p-5" colspan="20">
                                                <img src="{{ asset('/') }}client/images/ico_emptycart.svg" alt="Không có sách">
                                                <h3 class="mt-3">Hiện tại không có sách</h3>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class=" table table-bordered toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                        <tr>
                                            <th>#id</th>
                                            <th data-hide="image">Ảnh chính</th>
                                            <th data-hide="name">Tên sách</th>
                                            <th data-hide="category">Danh mục</th>
                                            <th data-hide="price">Giá</th>
                                            <th data-hide="hot">Sách hot</th>
                                            <th data-hide="status">Trạng thái</th>
                                            <th class="text-right">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($drafts->isNotEmpty())
                                        @foreach ($drafts as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td><img src="{{ $product->image_cover ? asset($product->image_cover) : asset('no_image.jpg') }}" width="50px">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                @if(!$product->price_sale)
                                                <strong class="text-danger">{{ $product->price }} đ</strong>
                                                @else
                                                <strong class="text-danger">{{ $product->price_sale }} đ</strong> <del>{{ $product->price }} đ</del>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->hot == 1)
                                                <span class="badge badge-success">Có</span>
                                                @else
                                                <span class="badge">Không</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($product->status == 'draft')
                                                <span class="badge badge-default">Bản nháp</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group gap-2 __custom_btn_group">
                                                    <a href="" class="btn btn-sm btn-warning">Sửa</a>
                                                    <form class="m-0" action="{{ route('adminproduct.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bản nháp này?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center p-5" colspan="20">
                                                <img src="{{ asset('/') }}client/images/ico_emptycart.svg" alt="Không có bản nháp">
                                                <h3 class="mt-3">Hiện tại không có bản nháp</h3>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/') }}backend/js/product/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection