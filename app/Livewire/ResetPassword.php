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
    #[Validate('required',message:'Số điện thoại không được để rỗng')] 
    #[Validate('regex:/^0[1-9]{1}[0-9]{8}$/', message: 'Số điện thoại không đúng định dạng')]
    public $phone='';
    #[Validate('required',message:'Email không được để rỗng')] 
    #[Validate('email',message:'Email không đúng định dạng')] 
    public $email='';
    public $token= '';
    public function handleReset(){
        $this->validate();
        try {
            $check = User::where('email',$this->email)->where('phone',$this->phone)->first();
            if ($check !== null) {
                $checkTokens = PasswordResetToken::where('email',$this->email)->first();
                if ($checkTokens) {
                    $result= PasswordResetToken::where('email',$this->email)->update([
                        'token'=>Hash::make(value: Str::random(60))
                    ]);
                }else{
                    PasswordResetToken::create([
                        'email'=>$this->email,
                        'token' =>Hash::make(Str::random(60))
                    ]);
                }
                $this->token = PasswordResetToken::where('email',$this->email)->first()['token'];
                Mail::to($this->email)->send(new ResetPasswordMail($this->token));
                session()->flash('successReset','Vui lòng kiểm tra email để đổi mật khẩu');
            }else{
                session()->flash('errorReset','Email hoặc số điện thoại của bạn không đúng');
            }
        } catch (\Throwable $th) {
            dd('failed');
        }
    }
    public function render()
    {
        return view('livewire.reset-password');
    }
}
