<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\couponModel;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CouponAdmin extends Component
{
    use WithFileUploads, WithPagination;

    public $coupons = [];
    public $paginationData;

    // Các trường trong bảng coupons
    public $couponId = '';
    public $code_coupon = '';
    public $description = '';
    public $start_date = '';
    public $expires_at = '';
    public $coupon_min_spend = '';
    public $coupon_max_spend = '';
    public $discount = '';
    public $type_coupon = '';
    public $quantity = '';
    public $status = 1; // Mặc định là hoạt động
    public $isModal = false;

    public function mount()
    {
        $this->loadCoupons();
    }

    public function loadCoupons()
    {
        $query = couponModel::query()->orderBy('id', 'desc');
        $paginator = $query->paginate(20);
        $this->coupons = $paginator->items();
        $this->updatePaginationData($paginator);
    }

    public function updatePaginationData($paginator)
    {
        $this->paginationData = [
            'currentPage' => $paginator->currentPage(),
            'lastPage' => $paginator->lastPage(),
            'total' => $paginator->total(),
            'perPage' => $paginator->perPage(),
        ];
    }

    public function closeModal()
    {
        $this->isModal = false;
        $this->reset([
            'couponId',
            'code_coupon',
            'description',
            'start_date',
            'expires_at',
            'coupon_min_spend',
            'coupon_max_spend',
            'discount',
            'type_coupon',
            'quantity',
            'status',
        ]);
    }

    public function createCoupon()
    {
        $this->validate([
            'code_coupon' => 'required|string|unique:coupons,code_coupon',
            'discount' => 'required|numeric',
            'type_coupon' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            couponModel::create([
                'code_coupon' => $this->code_coupon,
                'description' => $this->description,
                'start_date' => $this->start_date,
                'expires_at' => $this->expires_at,
                'coupon_min_spend' => $this->coupon_min_spend,
                'coupon_max_spend' => $this->coupon_max_spend,
                'discount' => $this->discount,
                'type_coupon' => $this->type_coupon,
                'quantity' => $this->quantity,
                'status' => $this->status,
            ]);

            $this->closeModal();
            $this->loadCoupons();
            session()->flash('create_success', 'Thêm mã giảm giá thành công');
        } catch (\Throwable $th) {
            session()->flash('create_error', 'Thêm mã giảm giá thất bại');
        }
    }

    public function editCoupon($id)
    {
        $coupon = couponModel::find($id);
        if (!$coupon) {
            session()->flash('edit_error', 'Không tìm thấy mã giảm giá');
            return;
        }

        $this->couponId = $coupon->id;
        $this->code_coupon = $coupon->code_coupon;
        $this->description = $coupon->description;
        $this->start_date = $coupon->start_date;
        $this->expires_at = $coupon->expires_at;
        $this->coupon_min_spend = $coupon->coupon_min_spend;
        $this->coupon_max_spend = $coupon->coupon_max_spend;
        $this->discount = $coupon->discount;
        $this->type_coupon = $coupon->type_coupon;
        $this->quantity = $coupon->quantity;
        $this->status = $coupon->status;

        $this->isModal = true;
    }

    public function updateCoupon()
    {
        $this->validate([
            'code_coupon' => 'required|string|unique:coupons,code_coupon,' . $this->couponId,
            'discount' => 'required|numeric',
            'type_coupon' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            couponModel::where('id', $this->couponId)->update([
                'code_coupon' => $this->code_coupon,
                'description' => $this->description,
                'start_date' => $this->start_date,
                'expires_at' => $this->expires_at,
                'coupon_min_spend' => $this->coupon_min_spend,
                'coupon_max_spend' => $this->coupon_max_spend,
                'discount' => $this->discount,
                'type_coupon' => $this->type_coupon,
                'quantity' => $this->quantity,
                'status' => $this->status,
            ]);

            $this->closeModal();
            $this->loadCoupons();
            session()->flash('update_success', 'Cập nhật mã giảm giá thành công');
        } catch (\Throwable $th) {
            session()->flash('update_error', 'Cập nhật mã giảm giá thất bại');
        }
    }

    public function deleteCoupon($id)
    {
        try {
            couponModel::destroy($id);
            $this->loadCoupons();
            session()->flash('delete_success', 'Xóa mã giảm giá thành công');
        } catch (\Throwable $th) {
            session()->flash('delete_error', 'Xóa mã giảm giá thất bại');
        }
    }

    public function render()
    {
        return view('livewire.coupon-admin');
    }
}
