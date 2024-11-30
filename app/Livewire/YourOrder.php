<?php

namespace App\Livewire;

use App\Models\BillDetailModel;
use App\Models\BillModel;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class YourOrder extends Component
{

    protected $listeners = ['cancel'];
    public function cancel($id)
    {
        try {
            $order = BillModel::where('id', $id)
                ->where('id_user', Auth::user()->id)
                ->with('billDetails')
                ->with('Coupon')
                ->firstOrFail();

            DB::transaction(function () use ($order) {
                // Duyệt qua từng sản phẩm trong chi tiết đơn hàng
                foreach ($order->billDetails as $billDetail) {
                    $product = Product::find($billDetail->id);
                    if ($product) {
                        $product->quantity += $billDetail->quantity;
                        $product->save();
                    }
                }

                if ($order->Coupon) {
                    $coupon = $order->Coupon;
                    if ($coupon->quantity !== null) {
                        $coupon->quantity += 1; // Tăng số lượng mã giảm giá
                        $coupon->save();
                    }
                }

                $order->status = 'cancel';
                $order->save();
            });
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
        $orders = BillModel::where('id_user', '=', Auth::user()->id)->paginate('20');
        return view('livewire.your-order', compact(['orders']));
    }
}
