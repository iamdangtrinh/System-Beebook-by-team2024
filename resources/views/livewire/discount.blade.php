<div>
        <div class="row mt-3 mb-3">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <input name="code" type="text" @if ($disable)
                    disabled
                @endif style="border:1px solid black; border-radius: 6px "
                    placeholder="Mã giảm giá" wire:model.live="code" >
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                @if ($disable)
                <button  style="padding: 11px ; background: red !important"  type="button" wire:click="RemoveCoupon" class="btn">Xóa mã</button>
                    @else
                    <button style="padding: 11.5px; width: 100%; " @if ($code === '') disabled @endif  type="button" wire:click="ApplyCoupon" class="btn">Áp dụng</button>
                @endif
            </div>
        </div>
        @if (session('errorCoupon'))
        <div class="error text-danger">
            {{ session('errorCoupon') }}
        </div>
    @endif
    @if (session('successCoupon'))
    <div class="success text-success">
        {{ session('successCoupon') }}
    </div>
@endif
@if (session('success_remove'))
<div class="success text-success">
    {{ session('success_remove') }}
</div>
@endif
</div>
