<?php

namespace App\Livewire;
use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ConfirmPassword extends Component
{
    #[Validate('required',message:'Mật khẩu không được để rỗng')] 
    #[Validate('min:8',message:'Mật khẩu chứa ít nhất 8 ký tự')] 
    #[Validate('regex:/^(?=.*[0-9])(?=.*[@$!%*#?&])(?=.*[A-Z]).*$/', message: 'Mật khẩu phải chứa ít nhất 1 số, 1 ký tự đặc biệt, và 1 ký tự hoa')]
    public $password='';
    #[Validate('required',message:'Xác nhận mật khẩu không được để rỗng')] 
    #[Validate('min:8',message:'Xác nhận mật khẩu chứa ít nhất 8 ký tự')] 
    #[Validate('regex:/^(?=.*[0-9])(?=.*[@$!%*#?&])(?=.*[A-Z]).*$/', message: 'Xác nhận mật khẩu phải chứa ít nhất 1 số, 1 ký tự đặc biệt, và 1 ký tự hoa')]
    #[Validate('same:password', message: 'Xác nhận mật khẩu và mật khẩu không trùng nhau')]
    public $password_confirm='';
    public $token; // Token từ URL
    public function mount($token)
    {
        $this->token = $token;
    }

    public function handleConfirm(){
        $getMailByToken = PasswordResetToken::where('token',$this->token)->first();
        if ($getMailByToken['email']) {
            try {
                User::where('email', $getMailByToken['email'])->update([
                    'password' => Hash::make($this->password_confirm)
                ]);
                PasswordResetToken::where('email', $getMailByToken['email'])->delete();
                // Mail::to($getMailByToken['email'])->send(new SendPassword($newPass));
                redirect(env('APP_URL').'sign-in');
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
