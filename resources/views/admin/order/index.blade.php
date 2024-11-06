<title>@yield('title', 'Đơn hàng')</title>
@extends('layout.admin')

@section('body')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>E-commerce orders</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="">E-commerce</a>
                </li>
                <li class="active">
                    <strong>Orders</strong>
                </li>
            </ol>
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
                                <th>Mã ĐH</th>
                                <th data-hide="phone">Họ và tên</th>
                                <th data-hide="phone">Số điện thoại</th>
                                <th data-hide="phone">Tổng tiền</th>
                                <th data-hide="phone">Ngày đặt hàng</th>
                                <th data-hide="phone,tablet">Cập nhật đơn hàng</th>
                                <th data-hide="status">Trạng thái</th>
                                <th data-hide="">Trạng thái thanh toán</th>
                                <th class="text-right">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result->id }}</td>
                                    <td>{{ $result->name }}</td>
                                    <td>{{ $result->phone }}</td>
                                    <td>{{ $result->total_amount }}</td>
                                    <td>{{ $result->created_at }}</td>
                                    <td>{{ $result->updated_at }}</td>
                                    <td>{{ $result->payment_status }}</td>
                                    <td>
                                        <span class="label cus_tom_label label-primary">{{ $result->payment_method }}</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group gap-2 w-100 __custom_btn_group">
                                            <a href="" class="badge text-light text-bg-warning">Chi tiết</a>
                                            <a href="" class="badge text-light text-bg-danger">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $results->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/') }}backend/js/order/index.js"></script>
@endsection
