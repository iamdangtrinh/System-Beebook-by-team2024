<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate; 
use Illuminate\Support\Facades\Auth;


class Signin extends Component
{
    #[Validate('required',message:'Email không được để rỗng')] 
    #[Validate('email',message:'Email không đúng định dạng')] 
    public $email = '';
    #[Validate('required',message:'Mật khẩu không được để rỗng')] 
    #[Validate('min:8',message:'Mật khẩu chứa ít nhất 8 ký tự')] 
    #[Validate('regex:/^(?=.*[0-9])(?=.*[@$!%*#?&])(?=.*[A-Z]).*$/', message: 'Mật khẩu phải chứa ít nhất 1 số, 1 ký tự đặc biệt, và 1 ký tự hoa')]
    public $password = '';
    // $validatedData = $this->validate((new SignInRequest())->rules(), (new SignInRequest())->messages());
    public function handleSignIn(){
        $this->validate();  
        // handle Sign in
        $user = Auth::attempt(['email'=>$this->email, 'password'=>$this->password]);
        if ($user === true) {
              redirect('/');      
        }else{
            session()->flash('SignInFailed','Tài khoản hoặc mật khẩu của bạn không đúng !');
        }
    }
    public function render()
    {
        return view('livewire.signin');
    }
}
