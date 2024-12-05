<title>@yield('title', 'Tổng quan')</title>
@extends('layout.admin')
@section('body')
    <div id="overview" class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Doanh thu</h5>
                        <span class="label label-success rounded">Tháng</span>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ number_format($amount_month, 0, '.', '.' ?? 0) }} đ</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Doanh thu của tháng</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Đơn hàng</h5>
                        <span class="label label-info rounded">Tháng</span>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $countOrder }}</h1>
                        <a target="_blank" href="{{ route('order.index') }}"><small>Có <span
                                    class="badge text-bg-primary">{{ $orderDayCount }}</span> đơn hàng mới trong
                                ngày</small></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tài khoản</h5>
                        <span class="label label-primary rounded">Tháng</span>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $countUser }}</h1>
                        <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                        <small>Đã đăng ký</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div Sản phẩm bán chạy nhất thángclass="ibox-title">
                        <h5>Thu nhập của hàng </h5>
                        <span class="label label-danger rounded">Tháng</span>
                    </div>
                    <div class="ibox-content p-0">
                        {{-- <h1 class="no-margins">80,600</h1>
                        <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i>
                        </div>
                        <small>In first month</small> --}}
                        <div id="orderForMonth" style="height: 50%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Đơn hàng hàng tháng</h5>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-xs btn-white active">1 Tháng</button>
                                <button type="button" class="btn btn-xs btn-white">6 Tháng</button>
                                <button type="button" class="btn btn-xs btn-white">Trong năm</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="chart_order_month"></div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="flot-chart-content" id="chart_order_count"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Sản phẩm bán chạy nhất tháng</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-hover no-margins">
                            <tbody>
                                @foreach ($topSellingProducts as $product)
                                    <tr>
                                        <td><img src="{{ $product->product_image ?? 'no_image.jpg' }}"
                                                alt="{{ $product->product_name }}" width="40px" height="40px"></td>
                                        <td>
                                            <a target="_blank"
                                                href="{{ route('adminproduct.edit', ['id' => $product->product_id]) }}">
                                                <small>{{ $product->product_name }}</small>
                                            </a>
                                        </td>
                                        <td><small>{{ $product->total_quantity_sold }}</small></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Mua nhiều nhất tháng</h5>
                        {{-- <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div> --}}
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover no-margins">
                            <thead>
                                <tr>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Số lần mua</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userBuyMost as $user)
                                    <tr>
                                        <td><small>{{ $user->name }}</small></td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->bills_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Small todo list</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <ul class="todo-list m-t small-list">
                            <li>
                                <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                <span class="m-l-xs todo-completed">Buy a milk</span>

                            </li>
                            <li>
                                <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                <span class="m-l-xs">Go to shop and find some products.</span>

                            </li>
                            <li>
                                <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                <span class="m-l-xs">Send documents to Mike</span>
                                <small class="label label-primary"><i class="fa fa-clock-o"></i> 1
                                    mins</small>
                            </li>
                            <li>
                                <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                <span class="m-l-xs">Go to the doctor dr Smith</span>
                            </li>
                            <li>
                                <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                <span class="m-l-xs todo-completed">Plan vacation</span>
                            </li>
                            <li>
                                <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                <span class="m-l-xs">Create new stuff</span>
                            </li>
                            <li>
                                <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                <span class="m-l-xs">Call to Anna for dinner</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>

    <script>
        $(document).ready(function() {
            // data chart
            let data = @json($orderYear);

            console.log(data);

            let month = data.map(function(item) {
                return item.month;
            });

            let total_amount = data.map(function(item) {
                return item.total_amount;
            });

            let success_count = data.map(function(item) {
                return item.success_count;
            });

            console.log(success_count);


            let optionOrderYear = {
                tooltip: {
                    trigger: 'axis',
                    formatter: function(params) {
                        const point = params[0];
                        return `${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(point.data)}`;
                    }
                },
                xAxis: {
                    data: month
                },
                yAxis: {
                    type: 'value',
                    axisLabel: {
                        formatter: function(value) {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(value);
                        }
                    }
                },
                series: [{
                        data: total_amount,
                        type: 'line',
                        smooth: true,
                        areaStyle: {},
                    },
                    {
                        data: success_count,
                        type: 'line',
                        stack: 'x',
                        areaStyle: {},

                    }
                ],
                width: '1000px'
            };

            var dataCount = success_count.map(function(count, index) {
                return {
                    value: count,
                    name: index === 0 ? 'Đơn thành công' : 'Đơn thất bại'
                };
            });

            let optionCountOrder = {
                series: [{
                    type: 'pie',
                    data: dataCount
                }]
            }

            var chart_order_count = echarts.init(document.getElementById('chart_order_count'));
            chart_order_count.setOption(optionCountOrder);

            var myChart = echarts.init(document.getElementById('chart_order_month'));
            myChart.setOption(optionOrderYear);
        });
    </script>
@endsection
