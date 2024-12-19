<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\couponModel;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCouponByEmail;

class CouponAdmin extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $coupons = [];
    public $paginationData;

    // Các trường trong bảng coupons
    public $couponId = '';
    public $id_coupon_loading = '';
    public $code_coupon = '';
    #[Validate('required', message: 'Chi tiết mã giảm giá không được để trống')]
    #[Validate('max:100', message: 'Chi tiết mã giảm giá không được vượt quá 100 ký tự')]
    public $description = '';
    #[Validate('required', message: 'Ngày bắt đầu không được để trống')]
    #[Validate('after_or_equal:today', message: 'Ngày bắt đầu phải sau hoặc bằng ngày hôm nay')]
    public $start_date = '';
    #[Validate('required', message: 'Ngày hết hạn không được để trống')]
    #[Validate('after:start_date', message: 'Ngày hết hạn phải sau ngày bắt đầu')]
    public $expires_at = '';
    #[Validate('required', message: 'Số tiền tối thiểu không được để trống')]
    #[Validate('numeric', message: 'Số tiền tối thiểu phải là số')]
    #[Validate('min:1', message: 'Số tiền tối thiểu phải lớn hơn 0')]
    public $coupon_min_spend = '';
    #[Validate('required', message: 'Số tiền tối đa không được để trống')]
    #[Validate('numeric', message: 'Số tiền tối đa phải là số')]
    #[Validate('gte:coupon_min_spend', message: 'Số tiền tối đa phải lớn hơn hoặc bằng số tiền tối thiểu')]
    public $coupon_max_spend = '';
    #[Validate('required', message: 'Giá trị giảm giá không được để trống')]
    #[Validate('numeric', message: 'Giá trị giảm giá phải là số')]
    #[Validate('min:0', message: 'Giá trị giảm giá phải lớn hơn 0')]
    public $discount = '';
    public $typeCoupon = 'amount';
    #[Validate('required', message: 'Số lượng không được để trống')]
    #[Validate('numeric', message: 'Số lượng phải là số')]
    #[Validate('min:1', message: 'Số lượng phải lớn hơn 0')]
    public $quantity = '';
    public $status = 1; // Mặc định là hoạt động
    public $isModal = false;
    public $idCoupon = '';
    public $statusCoupon = '';
    public $codeCoupon = '';
    public $dataEdit;
    public $arr = [];
    public $newValue = '';
    public $listEmail = [];
    public $valueStatus = 'active';
    #[Validate('required', message: 'Tên mã giảm giá không được để trống')]
    #[Validate('max:50', message: 'Tên mã giảm giá không được vượt quá 50 ký tự')]
    #[Validate('unique:coupons,code_coupon', message: 'Tên mã giảm giá đã tồn tại')]
    public $Value_code_coupon = '';


    public function mount()
    {
        $this->listEmail = User::get();
        $this->loadCoupons();
    }

    public function loadCoupons()
    {
        $query = couponModel::query()->orderBy('id', 'desc');
        if (!empty($this->idCoupon)) {
            $query->where('id', 'like', '%' . $this->idCoupon . '%');
        }
        if (!empty($this->statusCoupon)) {
            $query->where('status', 'like', '%' . $this->statusCoupon . '%');
        }
        if (!empty($this->codeCoupon)) {
            $query->where('code_coupon', 'like', '%' . $this->codeCoupon . '%');
        }
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
    public function updatedIdCoupon($value)
    {
        $this->idCoupon = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadCoupons();
    }
    public function updatedStatusCoupon($value)
    {
        $this->statusCoupon = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadCoupons();
    }
    public function updatedCodeCoupon($value)
    {
        $this->codeCoupon = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadCoupons();
    }
    // Hàm định dạng số tiền
    protected function formatCurrency($amount)
    {
        return number_format($amount, 0, ',', '.') . 'Đ';
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
    public function deleted_Coupon($value)
    {
        $this->couponId = $value;
        $this->dispatch('swal');
    }
    #[On('hanldeDeletedCoupon')]
    public function deletedCoupon()
    {
        $this->id_coupon_loading = $this->couponId;
        try {
            couponModel::destroy($this->couponId);
            $this->dispatch('toast', message: 'Xóa mã giảm giá thành công.', notify: 'success');
            $this->loadCoupons();
        } catch (\Throwable $th) {
            $this->dispatch('toast', message: 'Xóa mã giảm giá không thành công.', notify: 'error');
        }
    }
    public function closeModal()
    {
        $this->isModal = !$this->isModal;
        $this->dataEdit = [];
        $this->reset([
            'couponId',
            'Value_code_coupon',
            'description',
            'start_date',
            'expires_at',
            'coupon_min_spend',
            'coupon_max_spend',
            'discount',
            'typeCoupon',
            'quantity',
            'status',
        ]);
    }

    public function updatedValueStatus($value)
    {
        $this->valueStatus = $value;
    }
    public function updatedTypeCoupon($value)
    {
        $this->typeCoupon = $value;
    }
    public function updatedNewValue($value)
    {
        if (!is_array($this->arr)) {
            $this->arr = []; // Khởi tạo mảng rỗng nếu không phải mảng
        }

        // Kiểm tra giá trị trùng lặp
        if ($value && !in_array($value, $this->arr)) {
            $this->arr[] = $value; // Thêm giá trị vào mảng
            $this->newValue = '';  // Reset giá trị nhập vào
            $this->dispatch('toast', message: 'Thêm email vào danh sách thành công.', notify: 'success');
        } else {
            // Gửi sự kiện thông báo nếu giá trị đã tồn tại
            $this->dispatch('toast', message: 'Email đã tồn tại trong danh sách.', notify: 'warning');
        }
        // Kiểm tra xem nếu arr không phải là mảng, khởi tạo lại
    }
    public function removeEmail($value)
    {
        // Kiểm tra nếu arr là mảng và giá trị tồn tại trong mảng
        if (is_array($this->arr) && in_array($value, $this->arr)) {
            // Loại bỏ giá trị khỏi mảng
            $this->arr = array_filter($this->arr, fn($item) => $item !== $value);

            // Gửi sự kiện thông báo thành công
            $this->dispatch('toast', message: 'Xóa email khỏi danh sách thành công.', notify: 'success');
        } else {
            // Gửi thông báo nếu giá trị không tồn tại trong mảng
            $this->dispatch('toast', message: 'Email không tồn tại trong danh sách.', notify: 'warning');
        }
    }
    public function createCoupon()
    {
        try {
            couponModel::create([
                'code_coupon' => strtoupper($this->Value_code_coupon),
                'description' => $this->description,
                'start_date' => $this->start_date,
                'expires_at' => $this->expires_at,
                'coupon_min_spend' => $this->coupon_min_spend,
                'coupon_max_spend' => $this->coupon_max_spend,
                'discount' => $this->discount,
                'type_coupon' => $this->typeCoupon,
                'quantity' => $this->quantity,
                'status' => $this->status,
            ]);

            if ($this->arr !== []) {
                foreach ($this->arr as  $value) {
                    Mail::to($value)->send(new SendCouponByEmail(
                        $this->Value_code_coupon,
                        $this->description,
                        $this->start_date,
                        $this->expires_at,
                        $this->coupon_min_spend,
                        $this->coupon_max_spend,
                        $this->discount,
                        $this->typeCoupon,
                        $value
                    ));
                }
            }
            $this->closeModal();
            $this->arr = [];
            $this->loadCoupons();
            $paginator = couponModel::orderBy('id', 'desc')->paginate(20);
            $this->coupons = $paginator->items();
            $this->updatePaginationData($paginator);
            $this->dispatch('toast', message: 'Thêm khuyến mãi thành công.', notify: 'success');
        } catch (\Throwable $th) {
            $this->dispatch('toast', message: 'Thêm khuyến mãi không thành công.', notify: 'error');
        }
    }
    public function editCoupon($value)
    {
        $this->dataEdit = couponModel::find($value);
        $this->couponId = $this->dataEdit->id;
        $this->isModal = true;
        $this->Value_code_coupon = $this->dataEdit->code_coupon;
        $this->description = $this->dataEdit->description;
        $this->start_date = $this->dataEdit->start_date;
        $this->expires_at = $this->dataEdit->expires_at;
        $this->coupon_min_spend = $this->dataEdit->coupon_min_spend; // Định dạng tiền
        $this->coupon_max_spend = $this->dataEdit->coupon_max_spend; // Định dạng tiền
        $this->discount = $this->dataEdit->discount; // Định dạng tiền
        $this->typeCoupon = $this->dataEdit->type_coupon;
        $this->quantity = $this->dataEdit->quantity;
        $this->valueStatus = $this->dataEdit->status;
    }

    public function updateCoupon()
    {

        try {
            couponModel::where('id', $this->couponId)->update([
                'code_coupon' => $this->Value_code_coupon,
                'description' => $this->description,
                'start_date' => $this->start_date,
                'expires_at' => $this->expires_at,
                'coupon_min_spend' => $this->coupon_min_spend,
                'coupon_max_spend' => $this->coupon_max_spend,
                'discount' => $this->discount,
                'type_coupon' => $this->typeCoupon,
                'quantity' => $this->quantity
            ]);
            $this->closeModal();
            $this->loadCoupons();
            $this->dispatch('toast', message: 'Cập nhật khuyến mãi thành công.', notify: 'success');
        } catch (\Throwable $th) {
            $this->closeModal();
            $this->dispatch('toast', message: 'Cập nhật khuyến mãi không thành công.', notify: 'error');
        }
    }

    public function render()
    {
        return view('livewire.coupon-admin');
    }
}