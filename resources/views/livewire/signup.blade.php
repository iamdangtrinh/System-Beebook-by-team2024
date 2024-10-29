<div>
    <div class="page section-header text-center" style="margin-bottom: 0px !important">
        <div class="page-title">
            <div class="wrapper" >
                <h1 class="page-width">Đăng Ký</h1>
            </div>
        </div>
    </div>
    <div class=" d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row d-flex align-items-center">
                {{-- image --}}
                <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <img class="w-100" src="/client/images/manager-user/register.jpg" />
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
                                    <input wire:model.live="name" class="rounded-1"  placeholder="Họ tên" id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="">
                                    @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                             {{-- phone --}}
                             <div class="col-12 position-relative">
                                <div class="form-group">
                                    <label for="CustomerPhone">Số điện thoại</label>
                                    <input wire:model.live="phone" class="rounded-1"  placeholder="Số điện thoại" id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="">
                                    @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- Email --}}
                            <div class="col-12 position-relative">
                                <div class="form-group">
                                    <label for="CustomerEmail">Email</label>
                                    <input wire:model.live="email" class="rounded-1"  placeholder="Email" id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="">
                                    @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- Password --}}
                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label for="CustomerPassword">Mật khẩu</label>
                                    <input type="password" wire:model.live="password" class="rounded-1" placeholder="Mật khẩu" id="CustomerPassword">
                                    @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- Password Confirm --}}
                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label for="CustomerPassword">Xác nhận mật khẩu</label>
                                    <input type="password" wire:model.live="password_confirm" class="rounded-1" placeholder="Xác nhận mật khẩu" id="CustomerPassword">
                                    @error('password_confirm') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @if (session('success-sign-up'))
                            <div class="alert alert-success">
                                {{ session('success-sign-up') }}
                            </div>
                        @endif
                            {{-- Nút Đăng Nhập --}}
                            <button wire:click="handleSignUp"  wire:loading.attr="disabled" @if($errors->any()) disabled @endif type="button" class="btn pt-lg-3   rounded-1 pb-lg-3 fs-6">Đăng Ký</button>
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
    
</div>