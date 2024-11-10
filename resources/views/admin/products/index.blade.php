<title>@yield('title', 'Sách')</title>
@extends('layout.admin')

@section('body')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
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
    <div class="col-lg-2">
        <a href="{{ route('adminproduct.add') }}" class="btn btn-outline btn-primary btn-rounded">Thêm sách</a>
    </div>
</div>

<div class="row wrapper wrapper-content" style="padding: 20px 0 0 !important">
    <div class="ibox-content m-b-sm border-bottom">
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
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><img src="{{ $product->image_cover ? asset($product->image_cover) : asset('no_image.jpg') }}" width="50px">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                @if(!$product->price_sale)
                                <strong class="text-danger">{{ $product->price_sale }} đ</strong>
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
                                    <a href="" class="badge text-light text-bg-warning">Sửa</a>
                                    <a href="" class="badge text-light text-bg-danger">Xóa</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/') }}backend/js/product/index.js"></script>
@endsection