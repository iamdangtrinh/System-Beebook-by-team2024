
<title>
    @yield('title', 'Đăng nhập')
</title>
@extends('layout.client')
@section('body')
@livewireStyles
<div >
    <form action="" method="post">
        @csrf
    <div class="page section-header text-center" style="margin-bottom: 0px !important">
        <div class="page-title">
            <div class="wrapper" >
                <h1 class="page-width">Đăng Nhập</h1>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center mt-5">
        <div class="container">
            <div class="row d-flex align-items-center">
                {{-- image --}}
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <img class="w-100" src="/client/images/manager-user/signin.webp" />
                </div>
                {{-- form --}}
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="d-flex gap-3 flex-column">

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="d-flex gap-3">
                            <a style="background: white !important; border:1px solid grey" href="/auth/google"
                                class="btn w-100 border-1 pt-2 pb-2 rounded-1 fs-6">
                                <div class="d-flex justify-content-center align-items-center gap-2 text-center">
                                    <img alt="logo" style="width: 25px" src="/client/images/manager-user/logo_google.png" />
                                    <p>Google</p>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex gap-1">
                            <div class="w-100" style="border-bottom: 1px solid rgb(34, 33, 33)"></div>
                            Hoặc
                            <div class="w-100" style="border-bottom: 1px solid rgb(34, 33, 33)"></div>
                        </div>
                        {{-- Form Đăng Nhập --}}
                        <form wire:submit='handleSignIn' class="d-flex flex-column gap-3">
                            {{-- Email --}}
                            <div class="col-12 position-relative">
                                <div class="form-group">
                                    <label for="CustomerEmail">Email</label>
                                    <input name="email" class="rounded-1" placeholder="Email"
                                        id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="" value="{{ old('email') }}" >
                                    @error('email')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Mật khẩu --}}
                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label for="CustomerPassword">Mật khẩu</label>
                                    <div class="position-relative">
                                    <input type="password" name="password1" class="rounded-1"
                                        placeholder="Mật khẩu" id="CustomerPassword" value="{{ old('password1') }}">
                                        <div class="position-absolute" style="top: 25%; right: 10px; cursor: pointer;" onclick="togglePasswordLogin()">
                                            <i id="IconPassword" class="icon anm anm-eye-slash"></i>
                                        </div>
                                    </div>   
                                    @error('password1')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if (session('SignInFailed'))
                                <span class="error text-danger"> {{ session('SignInFailed') }}</span>
                            @endif
                            
                            @if (session('errorSignIn'))
                                <span class="error text-danger"> {{ session('errorSignIn') }}</span>
                            @endif
                            @if (session('successConfirmPassword'))
                            <span class="alert alert-success"> {{ session('successConfirmPassword') }}</span>
                        @endif
                            {{-- Remember me và Quên mật khẩu --}}
                            <div class="d-flex justify-content-between">
                                <div class="d-flex gap-1">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">Ghi nhớ</label>
                                </div>
                                <div>
                                    <a class="text-primary" href="/reset-password">Quên mật khẩu?</a>
                                </div>
                            </div>
                            {{-- Nút Đăng Nhập --}}
                            <button style="background: #CE2626 !important" type="submit" class="btn  pt-lg-3 rounded-1 pb-lg-3 fs-6 ">Đăng Nhập
                            </button>
                        </form>
                        <div class="d-flex gap-1 justify-content-center">
                            <p>Bạn chưa có tài khoản?</p>
                            <a href="/sign-up" class="text-primary">Đăng Ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script src="{{ asset('/') }}client/js/lib/toastr.js"></script>
<script>
    function togglePasswordLogin() {
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
</script>
@livewireScripts
@endsection