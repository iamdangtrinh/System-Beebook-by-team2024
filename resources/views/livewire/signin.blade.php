<div>
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Đăng Nhập</h1>
            </div>
        </div>
    </div>
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                {{-- image --}}
                <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <img class="w-100" src="/client/images/manager-user/banner_sign_in.png" />
                </div> 
                {{-- form --}}
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="d-flex gap-3 flex-column">
                        <div class="d-flex gap-3">
                            <button  type="button" class="w-100 border-1 pt-2 pb-2 rounded-1 fs-6">
                                <div class="d-flex justify-content-center align-items-center gap-2 text-center">
                                    <img style="width: 25px" src="/client/images/manager-user/logo_facebook.png" />
                                    <p>Facebook</p>
                                </div>
                            </button>
                            <button type="button" class="w-100 border-1 pt-2 pb-2 rounded-1 fs-6">
                                <div class="d-flex justify-content-center align-items-center gap-2 text-center">
                                    <img style="width: 25px" src="/client/images/manager-user/logo_google.png" />
                                    <p>Google</p>
                                </div>
                            </button>
                        </div>
                        <div class="d-flex gap-1">
                            <div class="w-100" style="border-bottom: 1px solid rgb(34, 33, 33)"></div>
                            Hoặc
                            <div class="w-100" style="border-bottom: 1px solid rgb(34, 33, 33)"></div>
                        </div>
                        {{-- Form Đăng Nhập --}}
                        <form class="d-flex flex-column gap-3"  >
                            {{-- Email --}}
                            <div class="col-12 position-relative">
                                <div class="form-group">
                                    <label for="CustomerEmail">Email</label>
                                    <input wire:model.live="email" class="rounded-1"  placeholder="Email" id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="">
                                    @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- Mật khẩu --}}
                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label for="CustomerPassword">Mật khẩu</label>
                                    <input wire:model.live="password" class="rounded-1" placeholder="Mật khẩu" id="CustomerPassword">
                                    @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- Remember me và Quên mật khẩu --}}
                            <div class="d-flex justify-content-between">
                                <div class="d-flex gap-1">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">Ghi nhớ</label>
                                </div>
                                <div>
                                    <a class="text-primary" href="#">Quên mật khẩu?</a>
                                </div>
                            </div>
                            {{-- Nút Đăng Nhập --}}
                            <button wire:click="handleSignIn"  wire:loading.attr="disabled" type="button" class="btn border-0 pt-lg-3   rounded-1 pb-lg-3 fs-6">Đăng Nhập</button>
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
    
</div>