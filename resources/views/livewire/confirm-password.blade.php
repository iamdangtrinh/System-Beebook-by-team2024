<div>
    <div class="page section-header">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width text-center">Nhập Mật Khẩu</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <form wire:submit="handleConfirm" class="d-flex flex-column gap-3" >
            <div class="row d-flex align-items-center" >
                <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <img alt="logo" class="w-100" src="/client/images/manager-user/signup.webp" />
                </div> 
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column gap-3">
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
                <button class="btn  pt-lg-3 rounded-1 pb-lg-3 fs-6 w-100" type="submit"  @if ($errors->any() || $password === '' || $password_confirm === '') disabled @endif  class="btn  pt-lg-3 rounded-1 pb-lg-3 fs-6">Xác nhận
                </button>
            </div>
            </div>
            
        </form>
       </div>
</div>
