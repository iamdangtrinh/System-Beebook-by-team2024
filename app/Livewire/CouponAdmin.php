<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\couponModel;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;


class CouponAdmin extends Component
{
    use WithFileUploads;
    use WithPagination;

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

    // Hàm định dạng số tiền
    protected function formatCurrency($amount)
    {
        return number_format($amount, 0, ',', '.') . 'Đ';
    }

    public function updatedcouponId($value)
    {
        $this->couponId = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadPosts();
    }

    public function previousPage()
    {
        if ($this->paginationData['currentPage'] > 1) {
            $this->gotoPage($this->paginationData['currentPage'] - 1);
        }
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->loadCoupons(); // Cập nhật theo trang hiện tại và bộ lọc
    }
    public function deleted_Coupon($couponId)
    {
        $this->couponId = $couponId;
        
        $this->dispatch('swal');
    }
    #[On('hanldeDeletedCoupon')]
    public function deletedCoupon()
{
    try {
        // Xóa mã giảm giá khỏi cơ sở dữ liệu
        couponModel::destroy($this->couponId);

        // Tải lại danh sách mã giảm giá (nếu cần)
        $this->loadCoupons();

        // Thông báo thành công
        session()->flash('deleted_success', 'Xóa mã giảm giá thành công');
    } catch (\Throwable $th) {
        // Nếu có lỗi trong quá trình xóa, thông báo lỗi
        session()->flash('deleted_error', 'Xóa mã giảm giá không thành công');
    }
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

            $this->redirect([ // Không cần dùng redirect ở đây, nếu không phải hành động điều hướng
                'code_coupon' => 'required|string|unique:coupons,code_coupon',
                'discount' => 'required|numeric',
                'type_coupon' => 'required|string',
                'quantity' => 'required|integer|min:1',
            ]);

            $this->closeModal();
            $this->loadCoupons();
            $paginator = couponModel::orderBy('id', 'desc')->paginate(20);
            $this->coupons = $paginator->items();
            $this->updatePaginationData($paginator);
            session()->flash('create_success', 'Thêm mã giảm giá thành công');
        } catch (\Throwable $th) {
            session()->flash('create_error', 'Thêm mã giảm giá thất bại');
        }
    }

    public function editCoupon($id)
    {
        $coupon = couponModel::find($id);
        $this->couponId = $coupon->id;
        $this->isModal = true;
        $this->code_coupon = $coupon->code_coupon;
        $this->description = $coupon->description;
        $this->start_date = Carbon::parse($coupon->start_date)->format('H:i-d-m-Y');
        $this->expires_at = Carbon::parse($coupon->expires_at)->format('H:i-d-m-Y');
        $this->coupon_min_spend = $this->formatCurrency($coupon->coupon_min_spend); // Định dạng tiền
        $this->coupon_max_spend = $this->formatCurrency($coupon->coupon_max_spend); // Định dạng tiền
        $this->discount = $this->formatCurrency($coupon->discount); // Định dạng tiền
        $this->type_coupon = $coupon->type_coupon;
        $this->quantity = $coupon->quantity;
        $this->status = $coupon->status;
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


    public function render()
    {
        return view('livewire.coupon-admin');
    }
}
