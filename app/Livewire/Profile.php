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

    #[Validate('required', message: 'Địa chỉ không được để rỗng')]
    public $address;
    public $chooseAddress;
    public $disabled = false;
    public $result;

    public function mount()
    {
        // $this->province = Auth::user()->id_city;
        $this->setUserData();
    }

    protected function setUserData()
    {
        $user = Auth::user();
        if ($user) {
            $this->result = User::where('id', $user->id)->first();
            $this->name =  $this->result->name;
            $this->phone =  $this->result->phone;
            $this->email =  $this->result->email;
            $this->address =  $this->result->address;
        }
    }

    public function handleEditProfile()
    {
        $this->validate();
        $user = Auth::user();
        $this->validateProfileChanges($user);
        $this->setUserData();
        $this->disabled = true;
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




    public function confirmDelete()
    {
        // Gửi sự kiện để kích hoạt SweetAlert
        $this->dispatch('swal');
    }
    #[On('hanldeDeleted')]
    public function deleted()
    {
        try {
            User::destroy('id', Auth::user()->id);
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