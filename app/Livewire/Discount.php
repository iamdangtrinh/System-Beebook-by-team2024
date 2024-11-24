<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\couponModel;
use Carbon\Carbon;
use App\Models\cartModel;
use Illuminate\Support\Facades\Auth;


class Discount extends Component
{
    public $code  = '';
    public $cart;
    public $price;
    public $disable;
    public $id;
    public function mount()
    {
        // $this->cart = $CartService->findCartByUser(20);
        $this->cart = cartModel::where('id_user', Auth::user()->id)->get();
        foreach ($this->cart as $value) {
            $this->price += $value['price'];
        }
        $this->code = session()->get('code', '');
        $this->disable = session()->get('disable');
    }
    public function ApplyCoupon()
    {
        $result_coupon = couponModel::where('code_coupon', $this->code)->where('status', 'active')->first();
        session()->put('id', $result_coupon['id']);
        if ($result_coupon !== null) {
            $start = Carbon::parse($result_coupon['start_date']);
            $expires_at = Carbon::parse($result_coupon['expires_at']);
            $now = Carbon::now();
            if ($now->lt($start)) {
                // Ngày hiện tại nhỏ hơn ngày bắt đầu
                session()->flash('errorCoupon', 'Mã giảm giá chưa tới ngày sử dụng');
            } elseif ($now->gt($expires_at)) {
                session()->flash('errorCoupon', 'Mã giảm giá đã hết hạn');
            } else {
                if ($result_coupon['quantity'] !== 0) {
                    if ($result_coupon['coupon-min-spend'] < $this->price && $this->price > $result_coupon['coupon-max-spend']) {
                        if ($result_coupon['type_coupon'] === 'percent') {
                            session()->put('price', $this->price * ($result_coupon['discount'] / 100));
                            session()->put('code', $this->code);

                            session()->put('disable', true);
                            session()->flash('successCoupon', 'Sử dụng mã khuyến mãi thành công  ');
                            couponModel::where('id', $result_coupon['id'])->decrement('quantity', 1);
                            return redirect()->to('/checkout');
                        } else {
                            session()->put('price', $result_coupon['discount']);
                            session()->put('code', $this->code);
                            session()->put('disable', true);
                            session()->flash('successCoupon', 'Sử dụng mã khuyến mãi thành công  ');
                            couponModel::where('id', $result_coupon['id'])->decrement('quantity', 1);
                            return redirect()->to('/checkout');
                        }
                    } else {
                        session()->flash('errorCoupon', 'Bạn không đủ điều kiện sử dụng khuyến mãi này  ');
                    }
                } else {
                    session()->flash('errorCoupon', 'Mã giảm giá đã hết');
                }
            }
        } else {
            session()->flash('errorCoupon', 'Mã giảm giá của bạn không đúng');
        }
    }
    public function RemoveCoupon()
    {
        couponModel::where('id',  session()->get('id'))->increment('quantity', 1);
        session()->forget(['price', 'code', 'id']); // Xóa các session cụ thể
        session()->put('disable', false);
        session()->flash('success_remove', 'Xóa mã giảm giá thành công');
        return redirect()->to('/checkout');
    }
    public function render()
    {
        return view('livewire.discount');
    }
}
