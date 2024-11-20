{{-- <title>@yield('title', 'Đơn hàng chi tiết . {{$orderDetails->id}}' )</title> --}}
@section('title')
    Đơn hàng chi tiết #{{ $orderDetails->id }}
@endsection
@extends('layout.admin')
@section('body')
    <div class="ibox">
        <div class="ibox-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0">Thông tin sản phẩm</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-nowrap align-middle table-borderless mb-0">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">Chi tiết sản phẩm</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col" class="text-end">Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{dd($orderDetails)}} --}}
                                            @foreach ($orderDetails->billDetails as $order)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                                <img src=" {{ asset('/') }}{{ $order->image_cover ?? 'no_image.jpg' }}"
                                                                    alt="" class="img-fluid d-block"
                                                                    style="width: 120px">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="fs-16"><a href="/san-pham/{{ $order->slug }}"
                                                                        class="link-primary">{{ $order->name }}</a>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ number_format($order->price, '0', '.', '.') . ' đ' }}</td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td class="fw-medium text-end">
                                                        {{ number_format($order->price * $order->quantity, '0', '.', '.') . ' đ' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @php
                            $payment_status =
                                $orderDetails->payment_status === 'PAID' ? 'Đã thanh toán' : 'Chưa thanh toán';
                            $payment_method =
                                $orderDetails->payment_method === 'ONLINE'
                                    ? 'Thanh toán online'
                                    : 'Thanh toán khi nhận hàng';

                        @endphp

                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="row mt-2">
                                    <div class="col-sm-12 col-md-6 col-xl-6">
                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td style="border: none; padding-left: 0px">Phương thức thanh toán :
                                                    </td>
                                                    <td style="border: none; padding-left: 0px" class="text-end">
                                                        {{ $payment_method }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none; padding-left: 0px">Trạng thái thanh toán :</td>
                                                    <td style="border: none;"
                                                        class="rouder  text-end text-<?= $orderDetails->payment_status == 'PAID' ? 'success' : 'danger' ?>">
                                                        {{ $payment_status }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none; padding-left: 0px">Giá giảm :</td>
                                                    <td style="border: none; padding-left: 0px" class="text-end">-$53.99
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none; padding-left: 0px">Phí vận chuyển :</td>
                                                    <td style="border: none; padding-left: 0px" class="text-end">
                                                        {{ number_format($orderDetails->fee_shipping, '0', '.', '.') . ' đ' }}
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td style="border: none; padding-left: 0px" scope="row">Tổng tiền :
                                                    </td>
                                                    <td style="border: none; padding-left: 0px" class="text-end">
                                                        {{ number_format($orderDetails->total_amount + $orderDetails->fee_shipping, '0', '.', '.') . ' đ' }}
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td style="border: none; padding-left: 0px" scope="row">Ghi chú đơn
                                                        hàng :</td>
                                                    <td style="border: none; padding-left: 0px" class="text-end">
                                                        {{ $orderDetails->note }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-6">
                                        <form action="{{ route('admin.order.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $orderDetails->id }}">
                                            <div class="row ">
                                                <div class="col-sm-12 col-md-6 col-xl-6">
                                                    <label style="padding-top: 8px" for="status">Cập nhật trạng thái đơn
                                                        hàng:</label>
                                                </div>

                                                <div class="col-sm-12 col-md-6 col-xl-6">
                                                    <select name="status" id="status" class="form-control setupSelect2">
                                                        @foreach (config('admin.order.statusOrder') as $key => $status)
                                                            <option {{ $orderDetails->status == $key ? 'selected' : '' }}
                                                                value="{{ $key }}">{{ $status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-xl-6">
                                                    <span class="mt-3 d-block">Quản trị ghi chú đơn hàng:</span>
                                                </div>

                                                <div class="col-sm-12 col-md-6 col-xl-6">
                                                    <textarea name="note_admin" id="" class="form-control mt-3" cols="20" rows="5"
                                                        placeholder="Nội dung ghi chú">{{$orderDetails->note_admin}}</textarea>
                                                </div>
                                            </div>

                                            <div class="text-end w-100 mt-3">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Cập nhật đơn hàng
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="d-flex">
                                    <h5 class="card-title flex-grow-1 mb-0">Trạng thái đơn hàng</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="/shippping.png" alt="shipping">
                                    <p class="text-muted mb-0">Mã đơn hàng: {{ $orderDetails->id }}</p>
                                    <div class="flex-shrink-0 mt-2">
                                        <span class="d-inline badge bg-primary-subtle text-primary fs-12">Đang vận
                                            chuyển</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="d-flex">
                                    <h5 class="card-title flex-grow-1 mb-0">Thông tin khách hàng</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0 vstack gap-3">
                                    <li class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('/') }}{{ $orderDetails->billUser->avatar ?? 'no_image.jpg' }}"
                                                alt="{{ $orderDetails->billUser->name }}" class="avatar-sm border"
                                                style="border-radius: 50%" width="160px" height="160px">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h4 class="fs-15 mt-2 mb-1">{{ $orderDetails->billUser->email }}</h4>
                                            <span class="fs-15 mb-1">{{ $orderDetails->billUser->phone }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Địa chỉ thanh toán</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled vstack gap-2 fs-14 mb-0">
                                    <li class="fw-semibold fs-15">{{ $orderDetails->billUser->name }}</li>
                                    <li>{{ $orderDetails->billUser->email }}</li>
                                    <li>{{ $orderDetails->billUser->phone }}</li>
                                    <li>{{ $orderDetails->billUser->address ?? 'Chưa có địa chỉ' }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Địa chỉ nhận hàng</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled vstack gap-2 fs-14 mb-0">
                                    <li class="">Họ tên nhận hàng: <span
                                            class="fw-semibold fs-15">{{ $orderDetails->name }}</span></li>
                                    <li>Số điện thoại: {{ $orderDetails->phone }}</li>
                                    <li>Địa chỉ nhận hàng: {{ $orderDetails->address }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/') }}backend/js/order/index.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/select2/select2.full.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/') }}backend/css/plugins/select2/select2.min.css">

    <style>
        
    </style>
@endsection
