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
                        {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
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
                        {{-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> --}}
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
            <div class="col-lg-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Sản phẩm bán chạy</h5>
                        <div class="pull-right">
                            <div class="btn-group">
                                <!-- Thêm data-range để truyền dữ liệu thời gian -->
                                <button type="button" class="btn btn-sm btn-white active" data-range="1">1 Tháng</button>
                                <button type="button" class="btn btn-sm btn-white" data-range="3">3 Tháng</button>
                                <button type="button" class="btn btn-sm btn-white" data-range="6">6 Tháng</button>
                                <button type="button" class="btn btn-sm btn-white" data-range="12">12 Tháng</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="mb-3">
                            Hiển thị :
                            <!-- Thêm id cho select để dễ quản lý -->
                            <select id="topSellingLimit" data-placeholder="Hiển thị" name="topSellingProducts">
                                <option value="3" selected>3</option>
                                <option value="6">6</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <table class="table table-hover no-margins">
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th class="text-center">Số lượng bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Nội dung sẽ được thêm động bởi JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-lg-5">
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
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
    <script>
        $(document).ready(function() {
            // DOM Elements
            const timeRangeButtons = document.querySelectorAll('.btn-group .btn');
            const limitSelect = document.querySelector('select[name="topSellingProducts"]');
            const tableBody = document.querySelector('table tbody');

            // Fetch Data Function
            function fetchData(timeRange, limit) {
                fetch(`/admin/get-top-selling-products?time_range=${timeRange}&limit=${limit}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing rows
                        tableBody.innerHTML = '';

                        // Populate table with new data
                        data.forEach(product => {
                            const row = `
                        <tr>
                            <td><img src="${product.product_image || 'no_image.jpg'}" 
                                     alt="${product.product_name}" 
                                     width="40px" height="40px"></td>
                            <td>
                                <a target="_blank" 
                                   href="/adminproduct/edit/${product.product_id}">
                                    <small>${product.product_name}</small>
                                </a>
                            </td>
                            <td class="text-center"><small>${product.total_quantity_sold}</small></td>
                        </tr>`;
                            tableBody.insertAdjacentHTML('beforeend', row);
                        });
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            // Add Click Event Listeners to Time Range Buttons
            timeRangeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons and add to clicked button
                    timeRangeButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    // Fetch data with the selected time range
                    const timeRange = parseInt(button.textContent.match(/\d+/)[
                    0]); // Extract number from text
                    fetchData(timeRange, parseInt(limitSelect.value));
                });
            });

            // Add Change Event Listener to Limit Dropdown
            limitSelect.addEventListener('change', () => {
                const activeButton = document.querySelector('.btn-group .btn.active');
                const timeRange = parseInt(activeButton.textContent.match(/\d+/)[0]);
                fetchData(timeRange, parseInt(limitSelect.value));
            });

            // Initial Fetch
            fetchData(1, parseInt(limitSelect.value)); // Default to 1 month, 3 products

            // Chart Data
            let data = @json($orderYear);
            let month = data.map(item => item.month);
            let total_amount = data.map(item => item.total_amount);
            let success_count = data.map(item => item.success_count);

            // Order Year Chart Options
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

            // Pie Chart Data
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
            };

            // Initialize Charts
            var chart_order_count = echarts.init(document.getElementById('chart_order_count'));
            chart_order_count.setOption(optionCountOrder);

            var myChart = echarts.init(document.getElementById('chart_order_month'));
            myChart.setOption(optionOrderYear);
        });
    </script>
@endsection
