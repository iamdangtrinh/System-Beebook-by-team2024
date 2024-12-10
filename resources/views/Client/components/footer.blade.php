<footer class="bg-light text-dark pt-5 mt-5">
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>

    <div class="container">
        <div class="row">
            <!-- Logo and Address -->
            <div class="col-md-3 col-sm-12 mb-3">
                <h5 class="fw-bold"><img src="{{ asset('/') }}client/images/logo.webp" height="50px" alt="Bee book" title="Logo" /></h5>
                <p style="text-align: justify">
                    76/58/26 Linh Trung, Thủ Đức, TP HCM Beebook.site nhận đặt hàng trực tuyến và giao hàng tận nơi. KHÔNG hỗ trợ đặt mua và nhận hàng trực tiếp
                    tại văn phòng cũng như tất cả Hệ Thống Beebook trên toàn quốc.
                </p>
            </div>
            <!-- My Account -->
            <div class="col-md-3 col-sm-12 mb-3">
                <h5 class="fw-bold">Tài Khoản Của Tôi</h5>
                <ul class="list-unstyled">
                    <li><a href="/sign-in" class="text-dark">Đăng nhập</a></li>
                    <li><a href="/sign-up" class="text-dark">Tạo mới tài khoản</a></li>
                    <li><a href="/profile" class="text-dark">Thay đổi địa chỉ khách hàng</a></li>
                    <li><a href="/profile" class="text-dark">Chi tiết tài khoản</a></li>
                    <li><a href="{{ route('your-order.index') }}" class="text-dark">Lịch sử đơn hàng</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-12 mb-3">
                <h5 class="fw-bold">Danh mục</h5>
                <ul class="list-unstyled">
                    @foreach ($result_category as $parentCategory)
                        @if ($parentCategory->children->isNotEmpty())
                            <li><a href="{{ url('danh-muc/' . $parentCategory->slug) }}"
                                    class="site-nav">{{ $parentCategory->name }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- Contact and Payment -->
            <div class="col-md-3 col-sm-12 mb-3">
                <h5 class="fw-bold">Liên Hệ</h5>
                <span>76/58/26 Linh Trung, Thủ Đức, TP HCM</span>
                <span>Email: <a href="mailto:cskh@beebook.com.vn" class="text-dark">cskh@beebook.com.vn</a></span>
                <span>Điện thoại: 0362094527</span>
            </div>
        </div>
        {{-- <hr>
        <div class="text-center p-3">
            <small>Giấy chứng nhận Đăng ký Kinh doanh số 0304132047 do Sở Kế hoạch và Đầu tư Thành phố Hồ Chí Minh cấp
                ngày 20/12/2005, đăng ký thay đổi lần thứ 10, ngày 20/05/2022.</small>
        </div> --}}
    </div>
</footer>

<!-- Including Jquery -->
<script src="{{ asset('/') }}client/js/vendor/jquery-3.3.1.min.js" defer></script>
<script src="{{ asset('/') }}client/js/vendor/modernizr-3.6.0.min.js" defer></script>
<script src="{{ asset('/') }}client/js/vendor/wow.min.js" defer></script>
<!-- Including Javascript -->
<script src="{{ asset('/') }}client/js/bootstrap.min.js" defer></script>
<script src="{{ asset('/') }}client/js/plugins.js" defer></script>
<script src="{{ asset('/') }}client/js/popper.min.js" defer></script>
<script src="{{ asset('/') }}client/js/lazysizes.js" defer></script>
<script src="{{ asset('/') }}client/js/main.js" defer></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    jQuery(document).ready(function() {
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6747e4ae2480f5b4f5a4f681/1idodaiqv';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    });
</script>
<!--End of Tawk.to Script-->

</body>
<html>
