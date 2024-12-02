<?php

namespace App\Livewire;

use App\Mail\verifySignUpByAdmin;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;



class UserAdmin extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $getAllUser = [];
    public $phone = '';
    public $email = '';
    public $idUser = '';
    public $paginationData;
    public $isModal = false;
    public $edit = '';
    public $valueAvatar = '';
    #[Validate('required', message: 'Họ tên không được để rỗng')]
    public $valueName = '';
    #[Validate('required', message: 'Số điện thoại không được để rỗng')]
    #[Validate('regex:/^0[1-9]{1}[0-9]{8}$/', message: 'Số điện thoại không đúng định dạng')]
    #[Validate('unique:users,phone', message: 'Số điện thoại đã tồn tại ')]
    #[Validate('unique:users,phone', message: 'Số điện thoại đã tồn tại')]

    public $valuePhone = '';
    #[Validate('required', message: 'Email không được để rỗng')]
    #[Validate('email', message: 'Email không đúng định dạng')]
    #[Validate('unique:users,email', message: 'Email đã tồn tại')]
    public $valueEmail = '';
    public $valueStatus = 'customer';
    public $valueStatus1 = '';
    public $chooseAddress = '';
    public $address = '';
    public $disabled = false;
    public $valueStatusConfirm = '';
    public $DataEditUser = [];
    public $loading =  false;
    public function mount()
    {
        $this->loadUsers();
    }

    // Load users với phân trang, có thể áp dụng bộ lọc
    public function loadUsers()
    {
        $query = User::query()->orderBy('id', 'desc');

        if (!empty($this->idUser)) {
            $query->where('id', 'like', '%' . $this->idUser . '%');
        }
        if (!empty($this->email)) {
            $query->where('email', 'like', '%' . $this->email . '%');
        }
        if (!empty($this->phone)) {
            $query->where('phone', 'like', '%' . $this->phone . '%');
        }

        // Thực hiện phân trang
        $paginator = $query->paginate(20);
        $this->getAllUser = $paginator->items();
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

    public function updatedIdUser($value)
    {
        $this->idUser = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadUsers();
    }

    public function updatedEmail($value)
    {
        $this->email = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadUsers();
    }

    public function updatedPhone($value)
    {
        $this->phone = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadUsers();
    }

    public function previousPage()
    {
        if ($this->paginationData['currentPage'] > 1) {
            $this->gotoPage($this->paginationData['currentPage'] - 1);
        }
    }

    public function nextPage()
    {
        if ($this->paginationData['currentPage'] < $this->paginationData['lastPage']) {
            $this->gotoPage($this->paginationData['currentPage'] + 1);
        }
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->loadUsers(); // Cập nhật danh sách user theo trang hiện tại và bộ lọc
    }
    public function closeModal()
    {
        $this->DataEditUser = [];

        $this->isModal = !$this->isModal;
    }
    public function updatedAddress($value)
    {
        if ($value !== '') {
            $response = Http::get("https://rsapi.goong.io/Place/AutoComplete?api_key=3llMTBYg6lewfO3NctgGOQWkynPkZojFyNm6HBpp&more_compound=true&radius=20000&input=" . $value);
            if ($response->successful()) {
                // $this->address = ;
                $this->chooseAddress = $response['predictions'];
            } else {
                session()->flash('error', 'Không thể tải dữ liệu');
            }
        }
        // dd($value);
    }
    public function removeImage()
    {
        if ($this->valueAvatar !== '' && Storage::disk('public')->exists('uploads/' . $this->valueAvatar)) {
            // Xóa hình ảnh khỏi thư mục
            Storage::disk('public')->delete(paths: 'uploads/' . $this->valueAvatar);
        }
        // Reset giá trị về mặc định
        $this->valueAvatar = '';
        $this->dispatch('toast', message: 'Xóa hình danh mục thành công.', notify: 'success');
    }
    public function addAddress($description)
    {
        $this->address = $description;
        $this->chooseAddress = [];
    }
    public function updatedValueAvatar($value)
    {
        $this->validate([
            'valueAvatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            $fileName = time() . str_replace(' ', '', $value->getClientOriginalName());
            $this->valueAvatar = $fileName;
            $value->storeAs('uploads', $fileName, 'public');
            $this->dispatch('toast', message: 'Thêm ảnh đại diện thành công.', notify: 'success');
        } catch (\Exception $th) {
            $this->dispatch('toast', message: 'Không thể cập nhật ảnh đại diện.', notify: 'error');
        }
    }
    public function updatedValueStatus($value)
    {
        $this->valueStatus = $value;
    }
    public function updatedValueStatus1($value)
    {
        $this->valueStatus1 = $value;
    }
    public function createUser()
    {
        $this->loading = true;
        $password_random = Str::random(10);
        $this->disabled = true;
        try {
            User::create([
                'name' => $this->valueName,
                'email' => $this->valueEmail,
                'phone' => $this->valuePhone,
                'avatar' => $this->valueAvatar ? $this->valueAvatar : 'no_avt.png',
                'address' => $this->address,
                'status' => 'active',
                'roles' => $this->valueStatus,
                'password' => Hash::make($password_random),
            ]);
            Mail::to($this->valueEmail)->send(new verifySignUpByAdmin($password_random));
            // dd($this->paginationData['currentPage']);
            $paginator = User::orderBy('id', 'desc')->paginate(20);
            $this->getAllUser = $paginator->items();
            $this->updatePaginationData($paginator);
            $this->dispatch('toast', message: 'Tạo tài khoản thành công.', notify: 'success');
        } catch (\Throwable $th) {
            $this->dispatch('toast', message: 'Tạo tài khoản thất bại.', notify: 'error');
        } finally {
            $this->disabled = false;
            $this->isModal = false;
            $this->loading = false;
            // Đặt lại các trường nhập liệu sau khi tạo thành công
            $this->reset([
                'valueName',
                'valueEmail',
                'valueAvatar',
                'valuePhone',
                'address',
                'valueStatus',
            ]);
            $this->valueStatus = 'customer'; // Giá trị mặc định cho valueStatus
        }
    }
    public function editUser($value)
    {
        try {
            $this->isModal = true;
            $this->DataEditUser = User::where('id', $value)->first();
            $this->valueName = $this->DataEditUser['name'];
            $this->valueEmail = $this->DataEditUser['email'];
            $this->valuePhone = $this->DataEditUser['phone'];
            $this->valueStatus = $this->DataEditUser['roles'];
            $this->valueStatus1 = $this->DataEditUser['status'];
            $this->valueAvatar = $this->DataEditUser['avatar'];
            $this->address = $this->DataEditUser['address'];
        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            $this->loading = false;
        }
    }
    public function updateUser()
    {
        try {
            User::where('id', $this->DataEditUser['id'])->update([
                'name' => $this->valueName,
                'phone' => $this->valuePhone,
                'email' => $this->valueEmail,
                'avatar' => $this->valueAvatar,
                'address' => $this->address,
                'status' => $this->valueStatus1,
                'roles' => $this->valueStatus,
            ]);
            $paginator = User::paginate(20);
            $this->getAllUser = $paginator->items();
            $this->updatePaginationData($paginator);
            $this->isModal = false;
            $this->reset([
                'valueName',
                'valueEmail',
                'valuePhone',
                'address',
                'valueStatus',
                'valueAvatar',
                'valueStatus1'
            ]);
            $this->valueStatus = 'customer';
            $this->DataEditUser = [];
            $this->dispatch('toast', message: 'Cập nhật tài khoản thành công.', notify: 'success');
            $paginator = User::orderBy('id', 'desc')->paginate(20);
            $this->getAllUser = $paginator->items();
            $this->updatePaginationData($paginator);
        } catch (\Throwable $th) {
            $this->dispatch('toast', message: 'Cập nhật tài khoản thất bại.', notify: 'error');
        }
    }
    public function render()
    {
        return view('livewire.user-admin');
    }
}