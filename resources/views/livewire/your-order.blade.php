<div class="pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12" style="">
                <div class="bg-white w-100" style="box-shadow: 0 0 40px rgba(0, 0, 0, 0.1); border-radius: 8px">
                    <h1
                        style="font-weight: bold; color: #C92127; padding: 18px 20px 12px 20px; border-bottom: 1px solid #F6F6F6 ">
                        TÀI KHOẢN</h1>
                    <div style="padding: 8px 10px" class="d-flex flex-column gap-1">
                        <a href="/profile" class="hover-item">Thông tin tài khoản</a>
                        <a href="{{ route('your-order.index') }}" class="hover-item">Đơn hàng của tôi</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="bg-white w-100"
                    style="box-shadow: 0 0 40px rgba(0, 0, 0, 0.1); padding: 20px 15px; border-radius: 8px">
                    <div class="table-responsive">
                        <table style="white-space: nowrap;" class="table table-bordered">
                            <thead>
                                <th>Mã ĐH</th>
                                <th>Ngày hoàn thành</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td class="d-flex"style="gap: 8px">
                                            <button class="btn btn-warning">Hủy</button>
                                            <a href="{{ route('your-order-detail.index', ['id' => $order->id]) }}"
                                                class="btn btn-danger">Xem</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .hover-item {
            color: black;
            transition: color 0.3s ease;
            font-weight: 500;
            border-bottom: 1px solid #F6F6F6;
            padding: 10px;

        }

        .hover-item:hover {
            color: #C92127;
            text-decoration: none;
        }

        .hover-item.active {
            color: #BF9A61;
        }
    </style>
</div>
