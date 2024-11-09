<title>@yield('title', 'Bài viết')</title>
@extends('layout.client')
@section('body')
    <div class="container-fluid">
        <div class="container" id="invoice">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order {{$orderDetails->id}}</h2>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card rounded mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <span class="me-3">{{date('H:i d-m-Y', strtotime($orderDetails->created_at))}}</span>
                                    {{-- <span class="me-3">#16123222</span> --}}
                                    <span class="me-3">Trạng thái đơn hàng: </span>
                                     <span class="badge rounded-pill bg-info">{{$orderDetails->status}}</span>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-link d-none d-lg-block btn-icon-text"> <span class="text">In hóa đơn</span></button>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex mb-2">
                                                <div class="flex-shrink-0">
                                                    <img src="https://www.bootdey.com/image/280x280/87CEFA/000000"
                                                        alt="" width="35" class="img-fluid">
                                                </div>
                                                <div class="flex-lg-grow-1 ms-3">
                                                    <h6 class="small mb-0"><a href="#" class="text-reset">Wireless
                                                            Headphones with Noise Cancellation Tru Bass Bluetooth HiFi</a>
                                                    </h6>
                                                    <span class="small">Color: Black</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>1</td>
                                        <td class="text-end">$79.99</td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Tạm tính</td>
                                        <td class="text-end">{{number_format($orderDetails->total_amount - $orderDetails->fee_shipping ?? 0, '0', '.', '.') . ' đ'}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Phí vận chuyển</td>
                                        <td class="text-end">{{number_format($orderDetails->fee_shipping, '0', '.', '.') . ' đ'}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Mã giảm giá (Code: NEWYEAR)</td>
                                        <td class="text-danger text-end">-$10.00</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="2">Tổng tiền</td>
                                        <td class="text-end">{{number_format($orderDetails->total_amount, '0', '.', '.') . ' đ'}}</td>
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
                                    <p>{{$orderDetails->payment_method == 'ONLINE' ? 'Thanh toán online' : 'Thanh toán khi nhận hàng'}}<br>
                                        {{number_format($orderDetails->total_amount, '0', '.', '.') . ' đ'}}
                                    <span class="badge bg-{{$orderDetails->payment_status === 'PAID' ? 'success' : 'danger'}} rounded-pill">{{$orderDetails->payment_status === 'PAID' ? 'Đã thanh toán' : 'Chưa thanh toán'}}</span></p>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Địa chỉ giao hàng</h3>
                                    <address>
                                        <strong>{{{$orderDetails->name}}}</strong><br>
                                        {{$orderDetails->address}}<br>
                                        <abbr title="Phone">Số điện thoại: </abbr> {{$orderDetails->phone}}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Customer Notes -->
                    <div class="card rounded mb-4">
                        <div class="card-body">
                            <h3 class="h6">Ghi chú</h3>
                            <p>{{$orderDetails->note}}</p>
                        </div>
                    </div>
                    <div class="card rounded mb-4">
                        <!-- Shipping information -->
                        <div class="card-body">
                            <h3 class="h6">Thông tin đặt hàng</h3>
                            <strong>Mã hóa đơn</strong>
                            <span><a href="#" class="text-decoration-underline" target="_blank">{{$orderDetails->id}}</a> <i
                                    class="bi bi-box-arrow-up-right"></i> </span>
                            <hr>
                            <h3 class="h6">{{Auth::user()->name}}</h3>
                            <address>
                                {{Auth::user()->address}}<br>
                                <abbr title="Phone">Số điện thoại: </abbr> {{Auth::user()->phone}}
                            </address>
                        </div>
                    </div>
                    <button>Hủy đơn hàng</button>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>


    <button onclick="generatePDF()">In Hóa Đơn</button>

<script>
    function generatePDF() {
        var element = document.getElementById('invoice');
        // Khởi tạo đối tượng jsPDF
        var opt = {
            margin:       1,
            filename:     `BeeBook hóa đơn số {{$orderDetails->id}}.pdf`,
            image:        { type: 'jpg', quality: 1 },
            html2canvas:  {
            scale: 1,
            letterRendering: true,
            useCORS: true,
            backgroundColor: '#ffffff', // Đảm bảo nền trắng
            x: 0,
            y: 0,
            width: element.offsetWidth,
            height: element.offsetHeight,
            logging: false,
            allowTaint: false
            },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };
        
        // Chuyển nội dung HTML thành PDF
        html2pdf().from(element).set(opt).save();
    }
</script>

    
    @endsection
