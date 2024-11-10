<div>
    <div class="page section-header">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width text-center">Quên Mật Khẩu</h1>
            </div>
        </div>
    </div>
    <div class="container">
       <div class="row d-flex align-items-center">
        <div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <img class="w-100" src="/client/images/manager-user/resetpassword.png" />
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
            @if (session('errorReset'))
                <span class="error text-danger"> {{ session('errorReset') }}</span>
            @endif
                <button type="submit"   @if ($errors->any() || $email === '' || session('successReset') )  disabled @endif class="btn  pt-lg-3 rounded-1 pb-lg-3 fs-6">Lấy lại mật khẩu
            </button>
            </form>
        </div>
       </div>
       </div>
</div>
