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
            <div class="col-lg-3">
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
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Thu nhập của tháng </h5>
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
                        <h5>Orders</h5>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-xs btn-white active">Today</button>
                                <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                <button type="button" class="btn btn-xs btn-white">Annual</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                {{-- draw chart --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Sản phẩm bán chạy nhất tháng</h5>
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
                        <table class="table table-hover table-bordered no-margins">
                            <thead>
                                <tr>
                                    <th>Tên sách</th>
                                    <th>Số lần bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topSellingProducts as $product)
                                    <tr>
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

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Mua nhiều nhất</h5>
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Transactions worldwide</h5>
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

                                <div class="row">
                                    <div class="col-lg-6">
                                        <table class="table table-hover margin bottom">
                                            <thead>
                                                <tr>
                                                    <th style="width: 1%" class="text-center">No.</th>
                                                    <th>Transaction</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td> Security doors
                                                    </td>
                                                    <td class="text-center small">16 Jun 2014</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$483.00</span></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td> Wardrobes
                                                    </td>
                                                    <td class="text-center small">10 Jun 2014</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$327.00</span></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td> Set of tools
                                                    </td>
                                                    <td class="text-center small">12 Jun 2014</td>
                                                    <td class="text-center"><span
                                                            class="label label-warning">$125.00</span></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-center">4</td>
                                                    <td> Panoramic pictures</td>
                                                    <td class="text-center small">22 Jun 2013</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$344.00</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">5</td>
                                                    <td>Phones</td>
                                                    <td class="text-center small">24 Jun 2013</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$235.00</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">6</td>
                                                    <td>Monitors</td>
                                                    <td class="text-center small">26 Jun 2013</td>
                                                    <td class="text-center"><span
                                                            class="label label-primary">$100.00</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="world-map" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('/') }}backend/css/custom.css" rel="stylesheet">
    <script>
        $(document).ready(function() {

            const data = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], // X-axis labels
                datasets: [{
                    label: 'Orders',
                    data: [150, 200, 250, 300, 400, 450, 500], // Y-axis data
                    borderColor: 'rgba(75, 192, 192, 1)', // Line color
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Background color under the line
                    tension: 0.1 // Smoothing the line
                }]
            };

            // Chart configuration
            const config = {
                type: 'line', // Line chart type
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            };

            // Create the chart
            const orderForMonthChart = new Chart(
                document.getElementById('orderForMonth'), // Target the canvas with the id 'orderForMonth'
                config
            );
        });
    </script>
@endsection
