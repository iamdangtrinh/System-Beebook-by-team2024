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
                        <a href="{{ route('your-order.index') }}" class="hover-item active">Đơn hàng của tôi</a>
                        <a href="{{ route('wishlist.index') }}" class="hover-item">Sản phẩm yêu thích</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="bg-white w-100"
                    style="box-shadow: 0 0 40px rgba(0, 0, 0, 0.1); padding: 20px 15px; border-radius: 8px">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <caption>Danh sách đơn hàng</caption>
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
                                        <td>{{ date('H:i:s d-m-Y', strtotime($order->created_at)) }}</td>
                                        <td>{{ number_format($order->total_amount, '0', '.', '.') . ' đ' }}</td>
                                        <td>
                                            @foreach (config('admin.order.statusOrderUser') as $key => $status)
                                                @if ($order->status === $key)
                                                    <span
                                                        class="badge {{ $order->status === $key ? config('admin.order.statusOrderColors')[$key] : '' }}">
                                                        {{ $order->status === $key ? $status : '' }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td><span
                                                class="{{ $order->payment_status === 'UNPAID' ? 'text-danger' : 'text-success' }}">{{ $order->payment_status === 'UNPAID' ? 'Chưa thanh toán' : 'Đã thanh toán' }}</span>
                                        </td>
                                        <td class="d-flex"style="gap: 8px">
                                            @if ($order->status !== 'cancel')
                                                <button wire:click="showAlert('{{ $order->id }}')"
                                                    class="btn btn-danger bg-danger">
                                                    Hủy
                                                </button>
                                            @else
                                                <span class="btn btn-danger bg-secondary">Đã hủy</span>
                                            @endif

                                            <a
                                                href="/profile/your-order/{{ $order->id }}"class="btn btn-danger">Xem</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('swal', (data) => {
                data = data[0]
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: data.icon,
                    showCancelButton: data.showCancelButton,
                    confirmButtonText: data.confirmButtonText,
                    cancelButtonText: data.cancelButtonText,
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (typeof Livewire !== 'undefined') {
                            Livewire.dispatch('cancel', {
                                id: data.id
                            });
                        } else {
                            console.error('Livewire is not available');
                        }
                    }
                });
            });
            Livewire.on('swal:success', (data) => {
                data = data[0]
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: 'success',
                });
            });

            Livewire.on('swal:error', (data) => {
                data = data[0]
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: 'error',
                });
            });
        });
    </script>
</div>
