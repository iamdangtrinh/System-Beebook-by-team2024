<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordResetToken;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    #[Validate('required', message: 'Email không được để rỗng')]
    #[Validate('email', message: 'Email không đúng định dạng')]
    public $email = '';
    public $token = '';
    public function handleReset()
    {
        $this->validate();
        try {
            $check = User::where('email', $this->email)->first();
            if ($check !== null) {
                $this->token =  Str::random(60);
                $checkTokens = PasswordResetToken::where('email', $this->email)->first();
                if ($checkTokens !== null) {
                    PasswordResetToken::where('email', $this->email)->update([
                        'token' => $this->token
                    ]);
                } else {
                    PasswordResetToken::create([
                        'email' => $this->email,
                        'token' => $this->token
                    ]);
                }
                Mail::to($this->email)->send(new ResetPasswordMail($this->token));
                session()->flash('successReset', 'Vui lòng kiểm tra email để đổi mật khẩu');
            } else {
                session()->flash('errorReset', 'Email của bạn không đúng');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function render()
    {
        return view(view: 'livewire.reset-password');
    }
}