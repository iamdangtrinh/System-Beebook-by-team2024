<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ConfirmPassword extends Component
{
    #[Validate('required', message: 'Mật khẩu không được để rỗng')]
    #[Validate('min:8', message: 'Mật khẩu chứa ít nhất 8 ký tự')]
    public $password = '';
    #[Validate('required', message: 'Xác nhận mật khẩu không được để rỗng')]
    #[Validate('min:8', message: 'Xác nhận mật khẩu chứa ít nhất 8 ký tự')]
    #[Validate('same:password', message: 'Xác nhận mật khẩu và mật khẩu không trùng nhau')]
    public $password_confirm = '';
    public $token; // Token từ URL
    public function mount($token)
    {
        $this->token = $token;
    }

    public function handleConfirm()
    {
        $getMailByToken = PasswordResetToken::where('token', $this->token)->first();
        if ($getMailByToken['email']) {
            try {
                User::where('email', $getMailByToken['email'])->update([
                    'password' => Hash::make($this->password_confirm)
                ]);
                PasswordResetToken::where('email', $getMailByToken['email'])->delete();
                session()->flash('successConfirmPassword', 'Đổi mật khẩu thành công');
                // Mail::to($getMailByToken['email'])->send(new SendPassword($newPass));
                redirect(env('APP_URL') . 'sign-in');
            } catch (\Throwable $th) {
                //throw $th;
                dd($th);
            }
        }
    }
    public function render()
    {
        return view('livewire.confirm-password');
    }
}