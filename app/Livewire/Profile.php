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
    public $toastDispatched = false;

    public $avatar;
    public $dataToUpdate = [];

    #[Validate('required', message: 'Địa chỉ không được để rỗng')]
    public $address;
    public $chooseAddress;
    public $disabled = false;
    public $result;
    public $Avt = '';

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
            $this->Avt = $this->result->avatar;
        }
    }

    // public function handleEditProfile()
    // {
    //     $this->validate();
    //     $user = Auth::user();
    //     $this->validateProfileChanges($user);
    //     $this->setUserData();
    //     $this->disabled = true;
    // }

    public function handleEditProfile()
    {
        $user = Auth::user();
        if ($user->name !== $this->name) {
            try {
                User::where('id', Auth::user()->id)->update(['name' => $this->name]);
                $this->dispatch('toast', message: 'Cập nhật tên thành công.', notify: 'success');
                $this->name = $user->name;
            } catch (\Throwable $th) {
                dd($th->getMessage());
                $this->dispatch('toast', message: 'Cập nhật tên thất bại.', notify: 'error');
            }
        }
        if ($this->phone !== $user->phone) {
            $this->validatePhone();
            try {
                User::where('id', Auth::user()->id)->update(['phone' => $this->phone]);
                $this->dispatch('toast', message: 'Cập nhật số điện thoại thành công.', notify: 'success');
                $this->phone = $user->phone;
            } catch (\Throwable $th) {
                $this->dispatch('toast', message: 'Cập nhật số điện thoại thất bại.', notify: 'error');
            }
        }

        if ($this->email !== $user->email) {
            $this->validateEmail();
            try {
                User::where('id', Auth::user()->id)->update(['email' => $this->email]);
                $this->dispatch('toast', message: 'Cập nhật email thất bại.', notify: 'success');
                $this->email = $user->email;
            } catch (\Throwable $th) {
                $this->dispatch('toast', message: 'Cập nhật email thất bại.', notify: 'error');
            }
        }
        if ($this->address !== $user->address) {
            try {
                User::where('id', Auth::user()->id)->update(['address' => $this->address]);
                $this->dispatch('toast', message: 'Cập nhật địa chỉ thành công.', notify: 'success');
                $this->address = $user->address;
            } catch (\Throwable $th) {
                $this->dispatch('toast', message: 'Cập nhật địa chỉ thất bại.', notify: 'error');
            }
        }
        $this->setUserData();
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
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'avatar.required' => 'Ảnh đại diện là bắt buộc.',
            'avatar.image' => 'Ảnh đại diện phải là một hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpeg, png, jpg, gif, hoặc svg.',
            'avatar.max' => 'Ảnh đại diện không được lớn hơn 2048 KB.',
        ]);
        try {
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            $fileName = time() . str_replace(' ', '', $value->getClientOriginalName());
            $this->avatar = $fileName;
            $value->storeAs('uploads', $fileName, 'public');
            User::where('id', Auth::id())->update(['avatar' => $fileName]);
            if (!$this->toastDispatched) {
                $this->dispatch('toast', message: 'Thêm ảnh đại diện thành công', notify: 'success');
                $this->toastDispatched = true;
            }
            $this->setUserData();
        } catch (\Exception $th) {
            $this->dispatch('toast', message: 'Không thể cập nhật ảnh đại diện thất bại.', notify: 'error');
        }
    }
    public function updatedAddress($value)
    {
        if ($value !== '') {
            try {
                $response = Http::timeout(1.5)
                    ->get("https://rsapi.goong.io/Place/AutoComplete", [
                        'api_key' => '3llMTBYg6lewfO3NctgGOQWkynPkZojFyNm6HBpp',
                        'more_compound' => true,
                        'radius' => 20000,
                        'input' => $value,
                    ]);
                if ($response->successful()) {
                    $this->chooseAddress = $response['predictions'];
                } else {
                    session()->flash('error', 'Không thể tải dữ liệu');
                }
            } catch (\Exception $e) {
                session()->flash('error', 'Lỗi kết nối, vui lòng thử lại!');
            }
        }
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
