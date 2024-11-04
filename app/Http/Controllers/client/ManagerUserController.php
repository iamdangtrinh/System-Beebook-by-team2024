<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use Illuminate\Support\Facades\Hash;
use App\Mail\verifySignUp;
use Illuminate\Support\Facades\Mail;

class ManagerUserController extends Controller
{
    public function SignIn()
    {
        return view('Client.signIn');
    }
    public function HandleSignIn(SignInRequest $request)
    {
        if (User::where('status', 'active')->whereNotNull('email_verified_at')->first()) {
            $user = Auth::attempt(['email' => $request->email, 'password' => $request->password1, 'status' => 'active']);
            if ($user === true) {
                return redirect('/profile');
            } else {
                session()->flash('SignInFailed', 'Tài khoản hoặc mật khẩu của bạn không đúng!');
                return redirect('/sign-in');
            }
        } else if (User::where('status', 'inactive')->whereNotNull('email_verified_at')->first()) {
            session()->flash('errorSignIn', 'Tài khoản của bạn đã bị khóa !');
            return redirect('/sign-in');
        } else {
            session()->flash('errorSignIn', 'Tài khoản của bạn chưa được kích hoạt !');
            return redirect('/sign-in');
        }
    }
    public function SignUp()
    {

        return view('Client.SignUp');
    }
    public function HandleSignUp(SignUpRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password_confirm)
            ]);
            Mail::to($request->email)->send(new verifySignUp($user->id));
            session()->flash('success-sign-up', 'Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản');
            return redirect('/sign-up');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function  LogOut()
    {
        Auth::logout();
        return redirect('/sign-in');
    }
    public function Profile()
    {
        return view('Client.profile');
    }
    // verify sign up 
    public function HandleVerifySignUp($id)
    {
        try {
            User::where('id', $id)->update([
                'email_verified_at' => now(),
                'status' => 'active'
            ]);
            return redirect('/sign-in');
        } catch (\Throwable $th) {
            //throw $th;`
            dd('Không xác nhận được');
        }
    }
    // Show form reset password
    public function ResetPassword()
    {
        return view('Client.resetPassword');
    }
    public function HandleConfirm($token)
    {
        return view('Client.confirmPassword', compact('token'));
    }

    public function yourOrder()
    {
        return view('Client.your-order');
    }
}