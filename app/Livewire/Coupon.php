<?php

namespace App\Livewire;

use App\Models\couponModel;
use Livewire\Component;

class Coupon extends Component
{

    public $code = '';
    protected $listeners = ['applyCoupon' => 'applyCoupon'];

    public function applyCoupon()
    {
        dd('Event received in Livewire');
    }
    public function Apply()
    {
        $result_coupon = couponModel::where('code_coupon', $this->code)
            ->where('status', 'active')
            ->where('quantity', '!=', 0)
            ->first();
        dd($result_coupon);
    }
    public function render()
    {
        return view('livewire.coupon');
    }
}
