<?php

namespace App\Livewire;

use App\Models\BillDetailModel;
use App\Models\BillModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class YourOrder extends Component
{

    protected $listeners = ['cancel'];
    public function cancel($id)
    {
        // $result = BillModel::where('id', $id)
        //     ->where('id_user', Auth::user()->id)
        //     ->update(['status' => 'cancel']);

        $ressult = BillDetailModel::where('id_bill', $id)->get();
        dd($ressult);

        // if ($result) {
        //     $this->dispatch('swal:success', (object)[
        //         'title' => 'Thành công',
        //         'text' => 'Đơn hàng đã được hủy.',
        //     ]);
        // } else {
        //     $this->dispatch('swal:error', (object)[
        //         'title' => 'Lỗi',
        //         'text' => 'Không thể hủy đơn hàng, vui lòng thử lại.',
        //     ]);
        // }
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
