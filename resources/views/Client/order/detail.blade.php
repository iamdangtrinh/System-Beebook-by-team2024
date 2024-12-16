<title>@yield('title', 'Chi tiết đơn hàng')</title>
@extends('layout.client')
@section('body')
    @php
        $statusMessages = [
            'new' => 'Đơn mới',
            'shipping' => 'Đang vận chuyển',
            'success' => 'Đã nhận được hàng',
            'cancel' => 'Đã hủy đơn hàng',
            'refund' => 'Hoàn tiền',
        ];
        $statusbgs = [
            'new' => 'info',
            'shipping' => 'warning',
            'success' => 'success',
            'cancel' => 'danger',
            'refund' => 'secondary',
        ];

        $statusMessage = $statusMessages[$orderDetails->status] ?? 'Trạng thái không xác định';
        $statusbg = $statusbgs[$orderDetails->status] ?? 'info';
    @endphp

    <div class="container-fluid">
        <div class="container" id="invoice">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Mã hóa đơn: {{ $orderDetails->id }}</h2>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card rounded mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <span
                                        class="me-3">{{ date('H:i d-m-Y', strtotime($orderDetails->created_at)) }}</span>
                                    <span class="me-3">Trạng thái đơn hàng: </span>
                                    <span
                                        class="badge rounded-pill 
                                        @switch($orderDetails->status)
                                            @case('new')
                                                bg-info
                                                @break

                                            @case('shipping')
                                                bg-warning
                                                @break

                                            @case('success')
                                                bg-success
                                                @break

                                            @case('cancel')
                                                bg-danger
                                                @break

                                            @case('refund')
                                                bg-secondary
                                                @break
                                        @endswitch">
                                        @switch($orderDetails->status)
                                            @case('new')
                                                Đơn mới
                                            @break

                                            @case('shipping')
                                                Đang vận chuyển
                                            @break

                                            @case('success')
                                                Giao thành công
                                            @break

                                            @case('cancel')
                                                Đã hủy
                                            @break

                                            @case('refund')
                                                Hoàn tiền
                                            @break
                                        @endswitch
                                    </span>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-success d-none d-lg-block btn-icon-text" id="downloadInvoice">
                                        <span class="text">In hóa đơn</span></button>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                    @foreach ($orderDetails->billDetails as $billDetail)
                                        <tr>
                                            <td>
                                                <div class="d-flex mb-2">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ $billDetail->image_cover ?? '/no_image.jpg' }}"
                                                            alt="{{ $billDetail->name }}" width="50" class="img-fluid">
                                                    </div>
                                                    <div class="flex-lg-grow-1 ms-3">
                                                        <h6 class="small mb-0"><a
                                                                href="{{ asset('/') }}san-pham/{{ $billDetail->slug }}"
                                                                class="text-reset">{{ $billDetail->name }}</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $billDetail->quantity }}</td>
                                            <td class="text-end">
                                                {{ number_format($billDetail->order_price, '0', '.', '.') . ' đ' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Phí vận chuyển</td>
                                        <td class="text-end">
                                            {{ number_format($orderDetails->fee_shipping, '0', '.', '.') . ' đ' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Mã giảm giá:
                                            {{ $orderDetails->Coupon !== null ? '(' . $orderDetails->Coupon->code_coupon . ')' : '' }}
                                        </td>

                                        <td class="text-success text-end">
                                            {{ number_format($orderDetails->discount, 0, '.', '.') . ' đ' }}
                                        </td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="2">Tổng tiền</td>
                                        <td class="text-end">
                                            {{ number_format($orderDetails->total_amount, '0', '.', '.') . ' đ' }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="card rounded mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="h6">Phương thức thanh toán</h3>
                                    <p>{{ $orderDetails->payment_method == 'ONLINE' ? 'Thanh toán online' : 'Thanh toán khi nhận hàng' }}<br>
                                        {{ number_format($orderDetails->total_amount, '0', '.', '.') . ' đ' }}
                                        <span
                                            class="badge bg-{{ $orderDetails->payment_status === 'PAID' ? 'success' : 'danger' }} rounded-pill">{{ $orderDetails->payment_status === 'PAID' ? 'Đã thanh toán' : 'Chưa thanh toán' }}</span>
                                    </p>
                                    @if ($orderDetails->payment_status !== 'PAID')
                                        <a href="{{route('order.show',['id' => $orderDetails->id] )}}">Click vào đây để thanh toán đơn hàng</a>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Địa chỉ giao hàng</h3>
                                    <address>
                                        <strong>{{ $orderDetails->name }}</strong><br>
                                        {{ $orderDetails->address }}<br>
                                        <abbr title="Số điện thoại">Số điện thoại: </abbr> {{ $orderDetails->phone }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Customer Notes -->
                    <div class="card rounded mb-4">

                        <div class="text-center">
                            <img src="/shippping.png" width="120px" alt="shipping">
                            <span class="d-block">Trạng thái đơn hàng</span>
                            <h3 class="h6 badge text-bg-{{ $statusbg }}">{{ $statusMessage }}</h3>
                        </div>

                        <div class="card-body">
                            <h3 class="h6">Ghi chú của bạn: </h3>
                            <p>{{ $orderDetails->note ?? 'Không có ghi chú nào' }}</p>
                        </div>
                        <div class="card-body">
                            <h3 class="h6">Quản trị viên ghi chú đơn hàng: </h3>
                            <p class="text-danger">{{ $orderDetails->note_admin ?? 'Không có ghi chú nào' }}</p>
                        </div>
                    </div>
                    <div class="card rounded mb-4">
                        <!-- Shipping information -->
                        <div class="card-body">
                            <h3 class="h6">Thông tin đặt hàng</h3>
                            <strong>Mã hóa đơn</strong>
                            <span><a href="#" class="text-decoration-underline"
                                    target="_blank">{{ $orderDetails->id }}</a> <i class="bi bi-box-arrow-up-right"></i>
                            </span>
                            <hr>
                            <h3 class="h6">{{ Auth::user()->name }}</h3>
                            <address>
                                {{ Auth::user()->address }}<br>
                                <abbr title="Số điện thoại">Số điện thoại: </abbr> {{ Auth::user()->phone }}
                            </address>
                            <div class="d-flex justify-content-between">
                                @if ($orderDetails->status === 'new')
                                    <button class="btn text-white bg-danger" id="cancelOrder"
                                        type-order="{{ $orderDetails->status }}" order-id="{{ $orderDetails->id }}">
                                        Hủy đơn hàng
                                    </button>
                                @endif

                                @if ($isDisabled === false && $orderDetails->status === 'success')
                                    <button class="btn text-white bg-secondary" id="refundOrder"
                                        type-order="{{ $orderDetails->status }}" order-id="{{ $orderDetails->id }}">
                                        Hủy đơn & hoàn tiền
                                    </button>
                                @endif

                                @if ($orderDetails->status === 'shipping')
                                    <button class="btn text-white bg-success" id="successOrder"
                                        type-order="{{ $orderDetails->status }}" order-id="{{ $orderDetails->id }}">
                                        Đã nhận được hàng
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('/') }}client/js/lib/pdf/jspdf.js"></script>
    <script src="{{ asset('/') }}client/js/lib/pdf/html2pdf.js"></script>
    <script src="{{ asset('/') }}client/js/customBillDetail.js"></script>
@endsection
