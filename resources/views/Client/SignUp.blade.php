@extends('layout.client')

<title>
    @yield('title', 'Đăng ký')
</title>
@section('body')
<div style="height: 75vh" >
    <form action="" method="post">
        @csrf
    <div class="page section-header text-center" style="margin-bottom: 0px !important">
        <div class="page-title">
            <div class="wrapper" >
                <h1 class="page-width">Đăng Ký</h1>
            </div>
        </div>
    </div>
    <div class=" d-flex align-items-center justify-content-center mt-5">
        <div class="container">
            <div class="row d-flex ">
                {{-- image --}}
                <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <img class="w-100" src="/client/images/manager-user/signup.png" />
                </div> 
                {{-- form --}}
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="d-flex gap-3 flex-column">
                        {{-- Form Đăng ký --}}
                        <form class="d-flex flex-column gap-3"  >
                             {{-- Name --}}
                             <div class="col-12 position-relative">
                                <div class="form-group">
                                    <label for="CustomerName">Họ tên</label>
                                    <input class="rounded-1" name="name"  placeholder="Họ tên" id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="" value="{{old('name')}}">
                                    @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                             {{-- phone --}}
                             <div class="col-12 position-relative">
                                <div class="form-group">
                                    <label for="CustomerPhone">Số điện thoại</label>
                                    <input  class="rounded-1" name="phone"  placeholder="Số điện thoại" id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="" value="{{old('phone')}}" >
                                    @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="col-12 position-relative">
                                <div class="form-group">
                                    <label for="CustomerEmail">Email</label>
                                    <input  class="rounded-1" name="email"   placeholder="Email" id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="" value="{{old('email')}}">
                                    @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- Password --}}
                            <div class="col-12">
                                <div class="form-group ">
                                    <label for="CustomerPassword">Mật khẩu</label>
                                    <div class="position-relative">
                                        <input type="password" name="password1" class="rounded-1" placeholder="Mật khẩu" id="CustomerPassword" value="{{old('password1')}}">
                                        <div class="position-absolute" style="top: 25%; right: 10px; cursor: pointer;" onclick="togglePassword()">
                                            <i id="IconPassword" class="icon anm anm-eye-slash"></i>
                                        </div>
                                    </div>
                                    @error('password1') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- Password Confirm --}}
                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label for="CustomerPassword">Xác nhận mật khẩu</label>
                                    <div class="position-relative">
                                        <input type="password" name="password_confirm" class="rounded-1" placeholder="Xác nhận mật khẩu" id="CustomerPasswordConfirm" value="{{ old('password_confirm') }}">
                                        <div class="position-absolute" style="top: 25%; right: 10px; cursor: pointer;" onclick="togglePasswordVisibility()">
                                            <i id="toggleIcon" class="icon anm anm-eye-slash"></i>
                                        </div>
                                    </div>
                                    @error('password_confirm') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @if (session('success-sign-up'))
                            <div class="alert alert-success">
                                {{ session('success-sign-up') }}
                            </div>
                        @endif
                            {{-- Nút Đăng Nhập --}}
                            <button  style="background: #CE2626 !important" type="submit" class="btn pt-lg-3   rounded-1 pb-lg-3 fs-6">Đăng Ký</button>
                        </form>
                        <div class="d-flex gap-1 justify-content-center">
                            <p>Bạn đã có tài khoản?</p>
                            <a href="/sign-in" class="text-primary">Đăng Nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script>
    function togglePassword() {
        const password = document.getElementById("CustomerPassword");
        const icon = document.getElementById("IconPassword");
        if (password.type === "password") {
            password.type = "text";
            icon.classList.remove("anm-eye-slash");
            icon.classList.add("anm-eye");
        } else {
            password.type = "password";          
            icon.classList.remove("anm-eye");
            icon.classList.add("anm-eye-slash");
        }
    }
    function togglePasswordVisibility() {
        const passwordConfirm = document.getElementById("CustomerPasswordConfirm");
        const toggleIcon = document.getElementById("toggleIcon");
        if (passwordConfirm.type === "password") {
            passwordConfirm.type = "text";
            toggleIcon.classList.remove("anm-eye-slash");
            toggleIcon.classList.add("anm-eye");
        } else {
            passwordConfirm.type = "password";          
            toggleIcon.classList.remove("anm-eye");
            toggleIcon.classList.add("anm-eye-slash");
        }
    }
</script>
@endsection