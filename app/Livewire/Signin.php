<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Signin extends Component
{
    #[Validate('required', message: 'Email không được để rỗng')]
    #[Validate('email', message: 'Email không đúng định dạng')]
    public $email = '';
    #[Validate('required', message: 'Mật khẩu không được để rỗng')]
    public $password = '';
    // $validatedData = $this->validate((new SignInRequest())->rules(), (new SignInRequest())->messages());
    public function handleSignIn()
    {
        $this->validate();
        // handle Sign in
        if (User::where('status', 'active')->whereNotNull('email_verified_at')->first()) {
            $user = Auth::attempt(['email' => $this->email, 'password' => $this->password, 'status' => 'active']);
            if ($user === true) {
                if (Auth::user()->role === 'admin') {
                    redirect('/admin');
                } else {
                    redirect('/profile');
                }
            } else {
                session()->flash('SignInFailed', 'Tài khoản hoặc mật khẩu của bạn không đúng!');
            }
        } else if (User::where('status', 'inactive')->whereNotNull('email_verified_at')->first()) {
            session()->flash('errorSignIn', 'Tài khoản của bạn đã bị khóa !');
        } else {
            session()->flash('errorSignIn', 'Tài khoản của bạn chưa được kích hoạt !');
        }
    }
    public function render()
    {
        return view('livewire.signin');
    }
}