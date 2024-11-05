<div>
    <div class="row mt-3 mb-3" >
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" >
            <input wire:model.live="code" type="text" style="border:1px solid black; border-radius: 6px " placeholder="Mã giảm giá  ">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" >
            <button @if ($code === '')
                disabled
            @endif  wire:click="Apply" class="btn " style="padding: 12px 20px" type="button">Áp dụng </button>
        </div>
    </div>
</div>
