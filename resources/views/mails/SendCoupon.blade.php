<div class="container my-5 p-4 text-dark rounded" style="max-width: 550px; background-color:#f9f9f9; border: 1px solid #ddd;">
   <a href="{{env('APP_URL')}}">
       <img src="{{env('APP_URL')}}{{ asset('/') }}client/images/logo.webp" alt="logo" class="d-block mx-auto mb-3" style="max-width: 120px;">
   </a>
   
   <h2 class="text-center fw-bold mb-4">Chúc mừng bạn nhận được Voucher!</h2>

   <p>Xin chào <strong>{{$email}}</strong>,</p>
   <p>Chúng tôi rất vui khi được gửi đến bạn một mã khuyến mãi đặc biệt:</p>

   <div class="bg-light text-dark p-3 rounded my-3">
       <p><strong>Mã Voucher:</strong> {{$code_coupon}}</p>
       @if ($type_coupon === 'amount')
       <p><strong>Giảm giá:</strong> {{number_format($discount).'đ'}}</p>
      @else
      <p><strong>Giảm giá:</strong> {{$discount}}%</p>
       @endif
      @if ($type_coupon === 'amount')
       <p><strong>Loại giảm giá:</strong>Tiền mặt</p>
          @else
       <p><strong>Loại giảm giá:</strong>Chuyển khoảng</p>
      @endif
       <p><strong>Số tiền tối thiểu:</strong> {{number_format($coupon_max_spend).'đ'}}</p>
       <p><strong>Số tiền tối đa:</strong> {{number_format($coupon_min_spend).'đ'}}</p>
       <p><strong>Chi tiết giảm giá:</strong> {{$description}}</p>
       <p><strong>Thời gian áp dụng:</strong> 
         {{ \Carbon\Carbon::parse($start_date)->format('H:i:s, d/m/Y') }} 
         đến 
         {{ \Carbon\Carbon::parse($expires_at)->format('H:i:s, d/m/Y') }}
     </p>
   </div>

   <p>Hãy sử dụng mã này ngay để tận hưởng ưu đãi đặc biệt từ chúng tôi. Đừng bỏ lỡ, mã chỉ có giá trị trong thời gian quy định!</p>

   <p class="mt-4">Trân trọng,</p>
   <p><strong>Đội ngũ hỗ trợ</strong></p>

   <hr>
   <p class="text-center small">Nếu bạn cần hỗ trợ, vui lòng liên hệ chúng tôi tại <strong>cskh@beebook.com.vn</strong></p>
</div>
