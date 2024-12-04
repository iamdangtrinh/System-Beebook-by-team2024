@php
    $payment_method =
        $resultBill->payment_method === 'ONLINE'
            ? 'Thanh toán online'
            : ($resultBill->payment_method === 'OFFLINE'
                ? 'Thanh toán khi nhận hàng'
                : 'Phương thức thanh toán không xác định');

    $payment_status =
        $resultBill->payment_status === 'PAID'
            ? 'Đã thanh toán'
            : ($resultBill->payment_status === 'UNPAID'
                ? 'Chưa thanh toán'
                : 'Trạng thái thanh toán không xác định');
@endphp

<div style="max-width:800px;margin:0 auto;padding:20px;background-color:#f9f9f9;">
    <img src="{{ asset('/client/images/logo.png') }}" style="width: 100%" alt="Bee book" title="Logo" />

    <div style="text-align: center;">
        <h2 style="text-align: center; color: #333;">Cảm ơn {{ $resultBill->name }} đã đặt hàng!</h2>
        <p style="text-align: center; color: #555;">Chúng tôi đã xử lý xong đơn hàng của bạn.</p>
        <p style="text-align: center; color: #555;">Tất cả thông tin cần thiết về việc giao hàng, chúng tôi đã gửi đến
            email của bạn.</p>
        <p
            style="color: white; background-color: #198754; padding: 5px 10px; border-radius: 5px; display: inline-block; margin: 10px 0; text-align: center;">
            Đơn hàng của bạn: <b>{{ $resultBill->id }}</b></p>
        <p style="text-align: center; color: #555;">Thời gian đặt hàng:
            {{ date('H:i:s d-m-Y', strtotime($resultBill->created_at)) }}</p>
    </div>

    <!-- Table for shipping and billing details -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <th
                style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #f2f2f2; font-weight: bold;">
                Địa chỉ giao hàng</th>
            <th
                style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #f2f2f2; font-weight: bold;">
                Địa chỉ thanh toán</th>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">
                Họ và tên: {{ $resultBill->name }}<br>
                Địa chỉ email: {{ $resultBill->email }}<br>
                Địa chỉ: {{ $resultBill->address }}<br>
                Số điện thoại: {{ $resultBill->phone }}
            </td>
            <td style="padding: 10px; border: 1px solid #ddd;">
                Họ và tên: {{ Auth::user()->name }}<br>
                Địa chỉ email: {{ Auth::user()->email }}<br>
                Địa chỉ: {{ Auth::user()->address }}<br>
                Số điện thoại: {{ Auth::user()->phone }}
            </td>
        </tr>
    </table>

    <!-- Table for shipping and payment methods -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <th
                style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #f2f2f2; font-weight: bold;">
                Phương thức vận chuyển</th>
            <th
                style="padding: 10px; border: 1px solid #ddd; text-align: left; background-color: #f2f2f2; font-weight: bold;">
                Phương thức thanh toán</th>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">
                Phương thức vận chuyển: {{ $resultBill->shipping_method }}<br>
                Phí vận chuyển: {{ number_format($resultBill->fee_shipping, '0', '.', '.') }} VNĐ
            </td>
            <td style="padding: 10px; border: 1px solid #ddd;">
                Phương thức thanh toán: {{ $payment_method }}<br>
                Trạng thái thanh toán: {{ $payment_status }}
            </td>
        </tr>
    </table>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('product.index') }}"
            style="background-color: transparent; border: 1px solid #007bff; color: #007bff; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-right: 10px;">Tiếp
            tục mua hàng</a>
        <a href="#"
            style="background-color: #dc3545; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">Mua
            lại</a>
    </div>
</div>
