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
    public $password = '';
    // $validatedData = $this->validate((new SignInRequest())->rules(), (new SignInRequest())->messages());
    public function handleSignIn(){
        $this->validate();  
        // handle Sign in
        $checkStatus=User::where('status','active')->first();
        if ($checkStatus) {
            $user = Auth::attempt(['email'=>$this->email, 'password'=>$this->password,'status'=>'active']);
            if ($user === true) {
                  redirect('/profile');      
            }else{
                session()->flash('SignInFailed','Tài khoản hoặc mật khẩu của bạn không đúng!');
            }
        }else{
            session()->flash('errorSignIn','Tài khoản của bạn đã bị khóa !');
        }  
    }
    public function render()
    {
        return view('livewire.signin');
    }
}
