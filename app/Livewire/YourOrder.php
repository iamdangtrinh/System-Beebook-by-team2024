<?php

namespace App\Livewire;

use App\Models\BillDetailModel;
use App\Models\BillModel;
use App\Models\couponModel;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class YourOrder extends Component
{
// tăng thêm số lương và mã giảm giá nếu huy order
    protected $listeners = ['cancel'];
    public function cancel($id)
    {
        try {
            $order = BillModel::where('id', $id)
                ->where('id_user', Auth::user()->id)
                ->with('billDetails')
                ->with('Coupon')
                ->firstOrFail();

            foreach ($order->billDetails as $key => $value) {
                $product = Product::select(['id', 'quantity'])->find($value->id);
                if ($product) {
                    Product::where('id', $value->id)->update(['quantity' => $product->quantity += $value->quantity]);
                }
            }

            if ($order->Coupon) {
                $coupon = $order->Coupon;
                couponModel::where('id', $coupon->id)->increment('quantity');
            }
            $order->update(['status' => 'cancel']);
            return $this->dispatch('swal:success', (object)[
                'title' => 'Thành công',
                'text' => 'Đơn hàng đã được hủy.',
            ]);
        } catch (\Exception $e) {
            return $this->dispatch('swal:error', (object)[
                'title' => 'Lỗi',
                'text' => 'Không thể hủy đơn hàng, vui lòng thử lại.',
            ]);
        }
    }

    public function showAlert(string $id)
    {
        $this->dispatch('swal', (object)[
            'title' => 'Xác nhận hủy đơn hàng?',
            'text' => 'Bạn có chắc chắn hủy đơn hàng không?',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Chắc chắn, hủy!',
            'cancelButtonText' => 'Đóng',
            'id' => $id,  // Pass the order ID
        ]);
    }

    use WithPagination, WithoutUrlPagination;
    public function render()
    {
        $orders = BillModel::where('id_user', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate('10');
        return view('livewire.your-order', compact(['orders']));
    }
}
