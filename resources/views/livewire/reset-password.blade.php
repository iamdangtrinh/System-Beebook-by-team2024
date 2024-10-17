<div>
    <div class="page section-header">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width text-center">Quên Mật Khẩu</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <form wire:submit="handleReset" class="d-flex flex-column gap-3" >
            <div class="col-12 position-relative">
                <div class="form-group">
                    <label for="CustomerEmail">Email</label>
                    <input wire:model.live="email" class="rounded-1" placeholder="Email"
                        id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="">
                    @error('email')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="col-12 position-relative">
                <div class="form-group">
                    <label for="CustomerEmail">Số điện thoại</label>
                    <input wire:model.live="phone" class="rounded-1" placeholder="Số điện thoại"
                        id="CustomerEmail" autocorrect="off" autocapitalize="off" autofocus="">
                    @error('phone')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @if (session('successReset'))
            <div class="alert alert-success"> {{ session('successReset') }}</div>
        @endif
        @if (session('errorReset'))
            <span class="error text-danger"> {{ session('errorReset') }}</span>
        @endif
            <button type="submit"   @if ($errors->any() || $token !== '') disabled @endif class="btn  pt-lg-3 rounded-1 pb-lg-3 fs-6">Lấy lại mật khẩu
        </button>
        </form>
       </div>
</div>
