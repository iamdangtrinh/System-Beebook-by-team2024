<title>@yield('title', 'Tổng quan')</title>
@extends('layout.admin')
@section('body')
    <div id="overview" class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-4">
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
            <div class="col-lg-4">
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
            <div class="col-lg-4">
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

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Đơn hàng hàng tháng</h5>
                        {{-- <div class="pull-right">
                            <select name="" id="showChartOrder" class="form-control">
                                <option value="1">1 Tháng</option>
                                <option value="3">3 Tháng</option>
                                <option value="6">6 Tháng</option>
                                <option value="12">12 Tháng</option>
                            </select>
                        </div> --}}
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="chart_order_month"></div>
                                </div>
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
                            <div id="timeRangeButtonsProducts" class="btn-group">
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
                            <select style="border-color: #b6b6b6;border-radius: 5px;" id="topSellingLimit"
                                data-placeholder="Hiển thị" name="topSellingProducts">
                                <option value="3" selected>3</option>
                                <option value="6">6</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div id="barRaceChart" style="width: 100%; height: 400px;"></div>
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

                        <select name="" id="selectMonth" class="">
                            <option value="1">1 Tháng</option>
                            <option value="3">3 Tháng</option>
                            <option value="6">6 Tháng</option>
                            <option value="12">12 Tháng</option>
                        </select>
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
                            <tbody id="userBuyMost">
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
            const timeRangeButtonsProducts = document.querySelectorAll('#timeRangeButtonsProducts .btn');
            const timeRangeButtonsOrders = document.querySelectorAll('#timeRangeButtonsOrders .btn');
            const limitSelect = document.querySelector('select[name="topSellingProducts"]');
            const tableBody = document.querySelector('table tbody');

            // Fetch Data Function
            function fetchData(timeRange, limit) {
                fetch(`/admin/get-top-selling-products?time_range=${timeRange}&limit=${limit}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing rows in the table
                        tableBody.innerHTML = '';

                        // Populate table with new data
                        data.forEach(product => {
                            const row = `
                        <tr>
                            <td><img src="${product.product_image || 'no_image.jpg'}" 
                                     alt="${product.product_name}" 
                                     width="40px" height="40px"></td>
                            <td>
                                <a target="_blank" href="/adminproduct/edit/${product.product_id}">
                                    <small>${product.product_name}</small>
                                </a>
                            </td>
                            <td class="text-center"><small>${product.total_quantity_sold}</small></td>
                        </tr>`;
                            tableBody.insertAdjacentHTML('beforeend', row);
                        });

                        // Update the Bar Race chart with new data
                        updateChartBarRace(data);
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            // Add Click Event Listeners to Time Range Buttons for Products
            timeRangeButtonsProducts.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons and add to clicked button
                    timeRangeButtonsProducts.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    // Fetch data with the selected time range (using the data-range attribute)
                    const timeRange = button.getAttribute('data-range');
                    fetchData(timeRange, parseInt(limitSelect.value));
                });
            });

            // Add Click Event Listeners to Time Range Buttons for Orders
            timeRangeButtonsOrders.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons and add to clicked button
                    timeRangeButtonsOrders.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    // Fetch data with the selected time range (no need to extract numbers, just handle the text)
                    const timeRange = button.textContent.trim(); // "1 Tháng", "6 Tháng", etc.
                    fetchData(timeRange, parseInt(limitSelect.value));
                });
            });

            // Add Change Event Listener to Limit Dropdown
            limitSelect.addEventListener('change', () => {
                const activeButton = document.querySelector('#timeRangeButtonsProducts .btn.active');
                const timeRange = activeButton.getAttribute('data-range');
                fetchData(timeRange, parseInt(limitSelect.value));
            });

            // Initial Fetch
            fetchData(1, parseInt(limitSelect.value)); // Default to 1 month, 3 products

            // Chart Data
            let data = @json($orderYear);
            let month = data.map(item => item.month);
            // let total_amount = data.map(item => item.total_amount);
            // let success_count = data.map(item => item.success_count);


            // Trình init
            // let optionOrderYear = {
            //     tooltip: {
            //         trigger: 'axis',
            //         formatter: function(params) {
            //             const point = params[0];
            //             return `${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(point.data)}`;
            //         }
            //     },
            //     xAxis: {
            //         data: month
            //     },
            //     yAxis: {
            //         type: 'value',
            //         axisLabel: {
            //             formatter: function(value) {
            //                 return new Intl.NumberFormat('vi-VN', {
            //                     style: 'currency',
            //                     currency: 'VND'
            //                 }).format(value);
            //             }
            //         }
            //     },
            //     series: [{
            //             data: total_amount,
            //             type: 'line',
            //             smooth: true,
            //             areaStyle: {},
            //         },
            //         {
            //             data: success_count,
            //             type: 'line',
            //             stack: 'x',
            //             areaStyle: {},
            //         }
            //     ],
            //     width: '1000px'
            // };

            // // Trình init
            // var myChart = echarts.init(document.getElementById('chart_order_month'));
            // myChart.setOption(optionOrderYear);

            // New Bar Race Chart (add this part for horizontal bar chart)
            function updateChartBarRace(data) {
                // Prepare data for Bar Race chart
                const categories = data.map(item => item.product_name);
                const quantities = data.map(item => item.total_quantity_sold);

                const barRaceChart = echarts.init(document.getElementById('barRaceChart')); // ID for Bar Race chart

                const optionBarRace = {
                    tooltip: {
                        trigger: 'axis',
                        formatter: function(params) {
                            const point = params[0];
                            return `${point.name}: ${point.value}`;
                        }
                    },
                    yAxis: {
                        type: 'category',
                        data: categories, // Categories (product names) on the Y-axis
                    },
                    xAxis: {
                        type: 'value', // Values (quantities) on the X-axis
                    },
                    series: [{
                        data: quantities,
                        type: 'bar',
                        showBackground: true,
                        itemStyle: {
                            color: '#3498db' // Customize the color of bars here
                        }
                    }]
                };

                barRaceChart.setOption(optionBarRace); // Update Bar Race chart with the new data
            }

            // get-user-buy-most
            $('#selectMonth').change(function() {
                let month = $(this).val();
                $.ajax({
                    url: '/admin/get-user-buy-most',
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        month: month
                    },
                    success: function(data) {
                        let html = '';
                        data.forEach(user => {
                            html += `
                            <tr>
                                <td><small>${user.name}</small></td>
                                <td>${user.email}</td>
                                <td>${user.phone}</td>
                                <td>${user.bills_count}</td>
                            </tr>
                            `;
                        });
                        $('#userBuyMost').html(html);
                    }
                });
            });

            const loadOnData = function() {
                $.ajax({
                    type: "get",
                    url: "/admin/get-order-month",
                    success: function(response) {
                        // let total_amount = Object.values(response.orderByMonth);
                        // let success_count = Object.values(response.orderSuccessByMonth);
                        // let cancel_count = Object.values(response.orderCancelByMonth);

                        // let DataCountOrder = {
                        //     xAxis: {
                        //         type: 'category',
                        //         data: month
                        //     },
                        //     yAxis: {
                        //         type: 'value',
                        //     },
                        //     series: [{
                        //             name: 'Total Orders',
                        //             data: total_amount,
                        //             type: 'line',
                        //             smooth: true,
                        //             areaStyle: {
                        //                 color: '#f7b924'
                        //             },
                        //             tooltip: {
                        //                 trigger: 'axis',
                        //                 formatter: function(params) {
                        //                     const point = params[0];
                        //                     return `Tổng đơn hàng: ${point.value}`;
                        //                 }
                        //             }
                        //         },
                        //         {
                        //             name: 'Success Orders',
                        //             data: success_count,
                        //             type: 'line',
                        //             smooth: true,
                        //             areaStyle: {
                        //                 color: '#3498db'
                        //             },
                        //             tooltip: {
                        //                 trigger: 'axis',
                        //                 formatter: function(params) {
                        //                     const point = params[0];
                        //                     return `Số đơn hàng thành công: ${point.value}`;
                        //                 }
                        //             }
                        //         },
                        //         {
                        //             name: 'Canceled Orders',
                        //             data: cancel_count,
                        //             type: 'line',
                        //             smooth: true,
                        //             areaStyle: {
                        //                 color: '#e74c3c'
                        //             },
                        //             tooltip: {
                        //                 trigger: 'axis',
                        //                 formatter: function(params) {
                        //                     const point = params[0];
                        //                     return `Số đơn hàng đã hủy: ${point.value}`;
                        //                 }
                        //             }
                        //         }
                        //     ]
                        // };

                        // let myChartCountOrder = echarts.init(document.getElementById(
                        //     'chart_order_month'));
                        // myChartCountOrder.setOption(DataCountOrder);

                        let total_amount = Object.values(response.orderByMonth);
                        let success_count = Object.values(response.orderSuccessByMonth);
                        let cancel_count = Object.values(response.orderCancelByMonth);

                        let DataCountOrder = {
                            tooltip: {
                                trigger: 'axis', // Show tooltip for all data points on the x-axis
                                formatter: function(params) {
                                    let tooltipText = '';
                                    params.forEach(point => {
                                        tooltipText +=
                                            `${point.marker} ${point.seriesName}: ${point.value}<br/>`;
                                    });
                                    return tooltipText;
                                }
                            },
                            xAxis: {
                                type: 'category',
                                data: month
                            },
                            yAxis: {
                                type: 'value',
                            },
                            series: [{
                                    name: 'Tổng đơn hàng',
                                    data: total_amount,
                                    type: 'bar',
                                    color: '#e4ae0b'
                                },
                                {
                                    name: 'Đơn hàng thành công',
                                    data: success_count,
                                    type: 'line',
                                    color: '#198754'
                                },
                                {
                                    name: 'Đơn hàng đã hủy',
                                    data: cancel_count,
                                    type: 'line',
                                    color: '#dc3545'
                                }
                            ]

                        };

                        let myChartCountOrder = echarts.init(document.getElementById(
                            'chart_order_month'));
                        myChartCountOrder.setOption(DataCountOrder);
                    }
                });
            }

            loadOnData();

        });
    </script>
@endsection
