<?php
namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

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
        // $this->province = Auth::user()->city_id;
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

            if ($user->city_id) {
                $this->userProvince = collect($this->dataProvince)->firstWhere('ProvinceID', $user->city_id);
                $this->fetchDataFromApiDistrict($user->city_id);
            }
            if ($user->province_id) {
                $this->userDistrict = collect($this->dataDistrict)->firstWhere('DistrictID', $user->province_id);
                $this->fetchDataFromApiWard($user->province_id);
            }
            if ($user->ward_id) {
                $this->userWard = collect($this->dataWard)->firstWhere('WardCode', $user->ward_id); 
            }
        }
    }

    public function handleEditProfile()
    {
        $this->validate();
        $user = Auth::user();
        
        $this->validateProfileChanges($user);

        if (!empty($this->dataToUpdate)) {
            $this->updateUserData();
        }
    }

    protected function validateProfileChanges($user)
    {
        if ($user->name !== $this->name) {
            $this->dataToUpdate['name'] = $this->name;
        }

        if ($this->phone !== $user->phone) {
            $this->validatePhone();
            $this->dataToUpdate['phone'] = $this->phone;
        }

        if ($this->email !== $user->email) {
            $this->validateEmail();
            $this->dataToUpdate['email'] = $this->email;
        }
        if ($this->province !== $user->city_id) {
            $this->dataToUpdate['city_id'] = $this->province;
        }
        if ($this->district !== $user->province_id) {
            $this->dataToUpdate['province_id'] = $this->district;
        }
        if ($this->ward !== $user->ward_id) {
            $this->dataToUpdate['ward_id'] = $this->ward;
        }
        if ($this->address !== $user->address) {
            $this->dataToUpdate['address'] = $this->address;
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
 
    protected function updateUserData()
    {
        try {
            User::where('id', Auth::user()->id)->update($this->dataToUpdate);
            session()->flash('success', 'Cập nhật thông tin thành công.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Cập nhật thông tin không thành công.');
        }

        return redirect()->to('/profile');
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
        if (Auth::user()->city_id !== $this->province ) {
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

    public function render()
    {
        return view('livewire.profile');
    }
}
