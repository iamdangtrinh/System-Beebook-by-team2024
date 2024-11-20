<?php

namespace App\Livewire;

use App\Mail\verifySignUpByAdmin;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
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
    public function mount()
    {
        $this->loadUsers();
    }

    // Load users với phân trang, có thể áp dụng bộ lọc
    public function loadUsers()
    {
        $query = User::query();

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
            $fileName = time() . '_' . $value->getClientOriginalName();
            $value->storeAs('uploads', $fileName, 'public');
            $this->valueAvatar = '';
            $this->valueAvatar = $fileName;
        } catch (\Exception $th) {

            session()->flash('error', 'Không thể cập nhật ảnh đại diện. Vui lòng thử lại.');
        }
    }
    public function updatedValueStatus($value)
    {
        $this->valueStatus = $value;
    }
    public function updatedValueStatus1($value)
    {
        try {
            User::where('id', $this->edit)->update(['status' => $value]);
            $paginator = User::paginate(20);
            $this->getAllUser = $paginator->items();
            $this->updatePaginationData($paginator);
            session()->flash('updateSuccess', 'Bạn đã đổi trạng thái thành công');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            session()->flash('update', 'Bạn đã đổi trạng thái thất bại');
        }
    }
    public function updatedValueStatusConfirm($value)
    {
        try {
            User::where('id', $this->edit)->update(['roles' => $value]);
            $paginator = User::paginate(20);
            $this->getAllUser = $paginator->items();
            $this->updatePaginationData($paginator);
            session()->flash('updateSuccess', 'Bạn đã đổi quyền thành công');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
            session()->flash('update', 'Bạn đã đổi quyền thất bại');
        }
    }
    public function createUser()
    {
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
            $paginator = User::paginate(20);
            $this->getAllUser = $paginator->items();
            $this->updatePaginationData($paginator);
            session()->flash('successCreate', 'Chúc mừng bạn đã tạo tài khoản thành công.');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            session()->flash('errorCreate', 'Không thể tạo tài khoản. Vui lòng thử lại.');
        } finally {

            $this->disabled = false;
            $this->isModal = false;

            // Đặt lại các trường nhập liệu sau khi tạo thành công
            $this->reset([
                'valueName',
                'valueEmail',
                'valuePhone',
                'address',
                'valueStatus',
            ]);
            $this->valueStatus = 'customer'; // Giá trị mặc định cho valueStatus
        }
    }
    public function editUser($value)
    {
        if ($this->edit === $value) {
            $this->edit = '';
        } else {
            $this->edit = $value;
        }
    }
    public function render()
    {
        return view('livewire.user-admin');
    }
}
