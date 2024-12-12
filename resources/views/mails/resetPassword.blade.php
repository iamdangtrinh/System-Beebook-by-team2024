<div class="container my-5 p-4 text-white rounded bg-white"  style="max-width: 550px; background-color:#f9f9f9;">
    <a href={{env('APP_URL')}}>
        <img src="{{env('APP_URL')}}.{{ asset('/') }}client/images/logo.webp" alt="background" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: -1; filter: brightness(50%);">
    </a>


    <h2 class="text-center fw-bold border-bottom pb-2 mb-4">Xác nhận đổi mật khẩu</h2>
 
    <p class="mb-4">Xin chào, vui lòng xác nhận email của bạn để được đổi mật khẩu. Chỉ cần nhấp vào liên kết bên dưới:</p>
       <a href="{{ env('APP_URL') }}confirm-password/{{ $token }}">Xác nhận</a>
    <p>Liên kết sẽ hết hạn sau 24 giờ, vì vậy hãy nhấp vào liên kết sớm nhất có thể. Vui lòng không bỏ qua email này bỏ qua email này.</p>
 
    <p class="mt-4">Trân trọng,</p>
    <p class="border-bottom pb-2 mb-4">Đội ngũ hỗ trợ</p>
    <p class="text-center small">Đối với các yêu cầu hỗ trợ, vui lòng liên hệ với chúng tôi tại <strong>cskh@beebook.com.vn</strong></p>
    {{-- <p class="text-center small">hoặc Hotline hỗ trợ: <strong>0376206645</strong></p> --}}
 </div>