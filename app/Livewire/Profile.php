<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate; 
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;


class Profile extends Component
{
    use WithFileUploads;

    #[Validate('required',message:'Họ tên không được để rỗng')] 
    public $name;
    #[Validate('required',message:'Số điện thoại không được để rỗng')] 
    #[Validate('regex:/^0[1-9]{1}[0-9]{8}$/', message: 'Số điện thoại không đúng định dạng')]

    public $phone='';
    #[Validate('required',message:'Email không được để rỗng')] 
    #[Validate('email',message:'Email không đúng định dạng')] 
    public $email='';
    public $avatar ;
    public $data = '';
    public $dataToUpdate = [];

    public function mount()
    {
        if (Auth::User()->name !=='' || Auth::User()->phone !=='' || Auth::User()->email !=='' ) {
            $this->name = auth()->user()->name ?? ''; // Khởi tạo giá trị ban đầu
            $this->phone = auth()->user()->phone ?? ''; // Khởi tạo giá trị ban đầu
            $this->email = auth()->user()->email ?? ''; // Khởi tạo giá trị ban đầu
        }
    }
    public function handleEditProfile(){
        if (Auth::user()->name !== $this->name) {
            $this->dataToUpdate['name'] = $this->name;
        }
        if ($this->phone !== Auth::user()->phone) {
            // Kiểm tra tính duy nhất của số điện thoại
            $this->validate([
                'phone' => [
                    Rule::unique('users', 'phone')->ignore(Auth::user()->id), 
                ],
            ]);
            $this->dataToUpdate['phone'] = $this->phone;
        }
        if ($this->email !== Auth::user()->email) {
            $this->validate([
                'email' => [
                    Rule::unique('users', 'email')->ignore(Auth::user()->id), 
                ],
            ]);
            $this->dataToUpdate['email'] = $this->email;
        }
        if (!empty($this->dataToUpdate)) {
            try {
                User::where('id',Auth::user()->id)->update($this->dataToUpdate);  // Cập nhật các trường đã thay đổi
                session()->flash('success', 'Cập nhật thông tin thành công.');
                session()->flash('error', '');
                return redirect()->to('/profile');
            } catch (\Throwable $th) {
                session()->flash('success', '');
                session()->flash('error', 'Cập nhật thông tin không thành công.');
            }
        } 
    }
    public function updatedAvatar($value)  {
        $this->handleUpLoadImage($value);
    }
    public function handleUpLoadImage($value){
        $this->validate(
            rules: [
                'avatar.required' => 'Vui lòng chọn một ảnh.', // Lỗi khi không chọn ảnh
                'avatar.image' => 'Tệp tải lên phải là một hình ảnh.',
                'avatar.mimes' => 'Định dạng ảnh không hợp lệ. Chỉ cho phép jpeg, png, jpg, gif, svg.',
            ]
        );
        if ($value) {
            $value->store('client','public');
            // $fileName = time() . '.' . $value->extension();
            // $path = public_path('/public/client/images/avatar/' . $fileName);
            // // Lưu tệp hình ảnh
            // // Lưu vào thư mục public/client/images/avatar
            // User::where('id',Auth::user()->id)->update(['avatar' => $path]); 
            session()->flash('success', 'Cập nhật ảnh đại diện thành công!');
        }
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
