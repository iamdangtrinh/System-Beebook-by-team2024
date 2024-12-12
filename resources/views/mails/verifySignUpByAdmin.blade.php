

<div class="container my-5 p-4 text-white rounded bg-white" style="max-width: 550px; background-color:#f9f9f9;">
    <a href={{env('APP_URL')}}>
       <img src="{{env('APP_URL')}}.{{ asset('/') }}client/images/logo.webp" alt="background" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: -1; filter: brightness(50%);">
    </a>
    
    <h2 class="text-center fw-bold border-bottom pb-2 mb-4">Xác Nhận Đăng Ký</h2>
 
    <p class="mb-4">Xin chào, Chúc mừng bạn đã đăng ký thành công:</p>
    <p>Mật khẩu của bạn là:"{{$password}}".</p>
 
    <p class="mt-4">Trân trọng,</p>
    <p class="border-bottom pb-2 mb-4">Đội ngũ hỗ trợ</p>
    <p class="text-center small">Đối với các yêu cầu hỗ trợ, vui lòng liên hệ với chúng tôi tại <strong>cskh@beebook.com.vn</strong></p>
    {{-- <p class="text-center small">hoặc Hotline hỗ trợ: <strong>0376206645</strong></p> --}}
 </div>