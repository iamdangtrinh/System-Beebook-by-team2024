<?php
namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;

class Profile extends Component
{
    use WithFileUploads;

    #[Validate('required', message: 'Họ tên không được để rỗng')] 
    public $name;

    #[Validate('required', message: 'Số điện thoại không được để rỗng')] 
    #[Validate('regex:/^0[1-9]{1}[0-9]{8}$/', message: 'Số điện thoại không đúng định dạng')]
    public $phone = '';

    #[Validate('required', message: 'Email không được để rỗng')] 
    #[Validate('email', message: 'Email không đúng định dạng')] 
    public $email = '';

    public $avatar;
    public $dataToUpdate = [];
    public $dataProvince = [];
    public $dataDistrict = [];
    public $dataWard = [];
    public $province = '';
    public $district = '';
    public $ward = '';
    public $userProvince = '';
    public $userDistrict = '';
    public $userWard = '';

    #[Validate('required', message: 'Địa chỉ không được để rỗng')] 
    public $address ;

    public function mount()
    {
        // $this->province = Auth::user()->id_city;
        $this->fetchDataFromApi();
        $this->setUserData();
    }

    protected function setUserData()
    {
        $user = Auth::user();
        if ($user) {
            $this->name = $user->name;
            $this->phone = $user->phone;
            $this->email = $user->email;
            $this->address = $user->address;

            if ($user->id_city) {
                $this->fetchDataFromApiDistrict($user->id_city);
                $this->userProvince = collect($this->dataProvince)->firstWhere('ProvinceID', $user->id_city);
                 $this->province = $user->id_city;
            }
            if ($user->id_province) {
                $this->fetchDataFromApiWard($user->id_province);
                $this->userDistrict = collect($this->dataDistrict)->firstWhere('DistrictID', $user->id_province);
            $this->district = $user->id_province;
                
            }
            if ($user->id_ward) {
                $this->userWard = collect($this->dataWard)->firstWhere('WardCode', $user->id_ward); 
            $this->ward = $user->id_ward;
            }
        }
    }

    public function handleEditProfile()
    {
        $this->validate();
        $user = Auth::user();
        $this->validateProfileChanges($user);
    }

    protected function validateProfileChanges($user)
    {
        if ($user->name !== $this->name) {
            try {
                User::where('id', Auth::user()->id)->update(['name' => $this->name]);
                session()->flash('success', 'Cập nhật thông tin thành công.');
                $this->name = $user->name;
            } catch (\Throwable $th) {
                session()->flash('error', 'Cập nhật thông tin không thành công.');
            }
        }
        if ($this->phone !== $user->phone) {
            $this->validatePhone();
            try {
                User::where('id', Auth::user()->id)->update(['phone' => $this->phone]);
                session()->flash('success', 'Cập nhật thông tin thành công.');
            $this->phone = $user->phone;
            } catch (\Throwable $th) {
                session()->flash('error', 'Cập nhật thông tin không thành công.');
            }
        }

        if ($this->email !== $user->email) {

            $this->validateEmail();
            try {
                User::where('id', Auth::user()->id)->update(['email' => $this->email]);
                session()->flash('success', 'Cập nhật thông tin thành công.');
            $this->email = $user->email;
            } catch (\Throwable $th) {
                session()->flash('error', 'Cập nhật thông tin không thành công.');
            }
        }
        if ($this->province !== $user->id_city) {
           
            try {
                User::where('id', Auth::user()->id)->update(['id_city' => $this->province]);
                session()->flash('success', 'Cập nhật thông tin thành công.');
            $this->province = $user->id_city;
            } catch (\Throwable $th) {
                session()->flash('error', 'Cập nhật thông tin không thành công.');
            }
        }
        if ($this->district !== $user->province_id) {
            try {
                User::where('id', Auth::user()->id)->update(['id_province' => $this->district]);
                session()->flash('success', 'Cập nhật thông tin thành công.');
                 $this->district = $user->id_province;
            } catch (\Throwable $th) {
                session()->flash('error', 'Cập nhật thông tin không thành công.');
            }
        }
        if ($this->ward !== $user->id_ward) {
       
            try {
                User::where('id', Auth::user()->id)->update(['id_ward' => $this->ward]);
                session()->flash('success', 'Cập nhật thông tin thành công.');
            $this->ward = $user->id_ward;
            } catch (\Throwable $th) {
                session()->flash('error', 'Cập nhật thông tin không thành công.');
            }
        }
        if ($this->address !== $user->address) {
      
            try {
                User::where('id', Auth::user()->id)->update(['address' => $this->address]);
                session()->flash('success', 'Cập nhật thông tin thành công.');
            $this->address = $user->address;
            } catch (\Throwable $th) {
                session()->flash('error', 'Cập nhật thông tin không thành công.');
            }
        }
    }

    protected function validatePhone()
    {
        $this->validate([
            'phone' => [
                Rule::unique('users', 'phone')->ignore(Auth::user()->id),
            ],
        ]);
    }

    protected function validateEmail()
    {
        $this->validate([
            'email' => [
                Rule::unique('users', 'email')->ignore(Auth::user()->id),
            ],
        ]);
    }

    public function updatedAvatar($value)
    {
        if ($value) {
            $this->handleUploadImage($value);
        }
    }
    public function handleUploadImage($value)
    {
        $this->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($value) {
            $path = $value->store('uploads', 'public');
            User::where('id', Auth::user()->id)->update(['avatar' => $path]);
            session()->flash('success', 'Cập nhật ảnh đại diện thành công!');
        }
    }
    public function fetchDataFromApi()
    {
        $response = Http::withHeaders([
            'Token' => 'ed187595-1fec-11ef-a9c4-9e9a72686e07',
        ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/province');

        if ($response->successful()) {
            $this->dataProvince = $response->json()['data'];
        } else {
            session()->flash('error', 'Không thể tải dữ liệu tỉnh thành.');
        }
    }
    public function updatedProvince()
    {
        $this->fetchDataFromApiDistrict($this->province);
        if (Auth::user()->id_city !== $this->province ) {
            $this->dataWard = [];
        }
    }

    public function updatedDistrict()
    {
        $this->fetchDataFromApiWard($this->district);
        // dd($this->dataWard);
    }

    public function fetchDataFromApiDistrict($province)
    {
        $response = Http::withHeaders([
            'Token' => 'ed187595-1fec-11ef-a9c4-9e9a72686e07',
        ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/district?province_id='.$province);
        if ($response->successful()) {
            $this->dataDistrict = $response->json()['data'];
        } else {
            session()->flash('error', 'Không thể tải dữ liệu quận/huyện.');
        }
    }
    public function fetchDataFromApiWard($district)
    {
        $response = Http::withHeaders([
            'Token' => 'ed187595-1fec-11ef-a9c4-9e9a72686e07',
        ])->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id='.$district);
        if ($response->successful()) {
            $this->dataWard = $response->json()['data'];
        } else {
            session()->flash('error', 'Không thể tải dữ liệu .');
        }
    }
    public function confirmDelete()
    {
        // Gửi sự kiện để kích hoạt SweetAlert
        $this->dispatch('swal');
    }
    #[On('hanldeDeleted')]
    public function deleted() {
        try {
            User::destroy('id',Auth::user()->id);
            redirect('/sign-in');
        } catch (\Throwable $th) {
            dd('Xóa không thành công');
        }
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
