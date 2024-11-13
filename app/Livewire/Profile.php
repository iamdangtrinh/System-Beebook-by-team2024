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
    // public function handleUploadImage($value)
    // {
    //     $this->validate([
    //         'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     try {
    //         // Lưu tệp vào thư mục 'uploads' trên đĩa 'public' và lấy đường dẫn
    //         $path = $value->store('uploads', 'public');

    //         // Cập nhật đường dẫn của ảnh đại diện trong cơ sở dữ liệu
    //         User::where('id', Auth::id())->update(['avatar' => $path]);

    //         // Thông báo thành công
    //         session()->flash('success', 'Cập nhật ảnh đại diện thành công!');
    //     } catch (\Exception $e) {
    //         // Thông báo lỗi và ghi log lỗi nếu có
    //         session()->flash('error', 'Không thể cập nhật ảnh đại diện. Vui lòng thử lại.');
    //     }
    // }
    public function handleUploadImage($value)
    {
        $this->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0775, true);
            }
            // Lưu tệp vào thư mục 'uploads' trên đĩa 'public'
            // $path = $value->storeAs('uploads', time() . '_' . $value->getClientOriginalName(), 'public');
            $fileName = time() . '_' . $value->getClientOriginalName();
            // Di chuyển tệp vào thư mục 'public/uploads'
            $value->storeAs('uploads', $fileName, 'public');
            // Cập nhật đường dẫn trong cơ sở dữ liệu
            User::where('id', Auth::id())->update(['avatar' => $fileName]);
            session()->flash('success', 'Cập nhật ảnh đại diện thành công!');
        } catch (\Exception $th) {
            dd($th->getMessage());
            // Thông báo lỗi nếu có
            session()->flash('error', 'Không thể cập nhật ảnh đại diện. Vui lòng thử lại.');
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
