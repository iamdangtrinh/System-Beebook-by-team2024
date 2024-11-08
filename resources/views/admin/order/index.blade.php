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
        <form action="" method="get">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label class="control-label" for="order_id">Hóa đơn</label>
                            <input type="text" id="order_id" name="order_id" value="" placeholder="Mã hóa đơn"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label class="control-label" for="status">Trạng thái đơn hàng</label>
                            <input type="text" id="status" name="status" value="" placeholder="Trạng thái"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label class="control-label" for="customer">Khách hàng</label>
                            <input type="text" id="customer" name="customer" value="" placeholder="Khách hàng"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <div class="form-group">
                            <label class="control-label" for="amount">Tổng tiền</label>
                            <input type="text" id="amount" name="amount" value="" placeholder="Tổng tiền"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
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
                            @if(count($results) > 0)
                            @foreach ($results as $result)
                                @php
                                    $payment_status =
                                        $result->payment_status === 'PAID' ? 'Đã thanh toán' : 'Chưa thanh toán';
                                    $payment_method =
                                        $result->payment_method === 'ONLINE'
                                            ? 'Thanh toán online'
                                            : 'Thanh toán khi nhận hàng';
                                    $dateCreate = date('H:i d/m/Y', strtotime($result->created_at));
                                    $dateUpdate = date('H:i d/m/Y', strtotime($result->updated_at));
                                    $total_amount = number_format($result->total_amount, '0', '.', '.') . ' đ';
                                @endphp

                                <tr>
                                    <td>{{ $result->id }}</td>
                                    <td>{{ $result->name }}</td>
                                    <td>{{ $result->phone }}</td>
                                    <td>{{ $total_amount }}</td>
                                    <td>{{ $dateCreate }}</td>
                                    <td>{{ $dateUpdate }}</td>
                                    <td>
                                        <span
                                            class="label cus_tom_label rounded label-<?= $result->payment_status == 'PAID' ? 'primary' : 'warning' ?>">{{ $payment_status }}</span>
                                    </td>
                                    <td>
                                        <span class="label cus_tom_label">{{ $payment_method }}</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group gap-2 w-100 __custom_btn_group">
                                            <a href="" class="badge text-light text-bg-warning">Chi tiết</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else 
                            <tr>
                                <td class="text-center p-5" colspan="20">
                                    <img src="{{ asset('/') }}client/images/ico_emptycart.svg" alt="Không có đơn hàng">
                                    <h3 class="mt-3">Hiện tại không có đơn hàng</h3>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $results->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/') }}backend/js/order/index.js"></script>
@endsection
