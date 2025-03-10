<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Mail\verifySignUp;
use Illuminate\Support\Facades\Mail;

class Signup extends Component
{
    protected  $UserService;
    #[Validate('required',message:'Họ tên không được để rỗng')] 
    public $name='';
    #[Validate('required',message:'Số điện thoại không được để rỗng')] 
    #[Validate('regex:/^0[1-9]{1}[0-9]{8}$/', message: 'Số điện thoại không đúng định dạng')]
    #[Validate('unique:users,phone',message:'Số điện thoại đã tồn tại ')] 

    public $phone='';
    #[Validate('required',message:'Email không được để rỗng')] 
    #[Validate('email',message:'Email không đúng định dạng')] 
    #[Validate('unique:users,email',message:'Email đã tồn tại')] 
    public $email='';
     #[Validate('required',message:'Mật khẩu không được để rỗng')] 
    #[Validate('min:8',message:'Mật khẩu chứa ít nhất 8 ký tự')] 
    #[Validate('regex:/^(?=.*[0-9])(?=.*[@$!%*#?&])(?=.*[A-Z]).*$/', message: 'Mật khẩu phải chứa ít nhất 1 số, 1 ký tự đặc biệt, và 1 ký tự hoa')]
    public $password='';
    #[Validate('required',message:'Xác nhận mật khẩu không được để rỗng')] 
    #[Validate('min:8',message:'Xác nhận mật khẩu chứa ít nhất 8 ký tự')] 
    #[Validate('regex:/^(?=.*[0-9])(?=.*[@$!%*#?&])(?=.*[A-Z]).*$/', message: 'Xác nhận mật khẩu phải chứa ít nhất 1 số, 1 ký tự đặc biệt, và 1 ký tự hoa')]
    #[Validate('same:password', message: 'Xác nhận mật khẩu và mật khẩu không trùng nhau')]
    public $password_confirm='';
    // public function mount(UserService $UserService) {
    //     $this->UserService=$UserService;
    // }
    public function handleSignUp(){
        $this->validate();
        try {
           $user=User::create([
                'name' => $this->name,
                'email' => $this->email, // Sử dụng $this->email
                'phone' => $this->phone, // Sử dụng $this->phone
                'password' => Hash::make($this->password_confirm) // Mã hóa mật khẩu trước khi lưu
            ]);
            Mail::to($this->email)->send(new verifySignUp($user->id));
            // redirect('/sign-in');
            session()->flash('success-sign-up','Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.signup');
    }
}
