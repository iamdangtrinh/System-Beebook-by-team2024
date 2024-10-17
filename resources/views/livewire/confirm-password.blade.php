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
            <button type="submit" class="btn  pt-lg-3 rounded-1 pb-lg-3 fs-6">Xác nhận
        </button>
        </form>
       </div>
</div>
