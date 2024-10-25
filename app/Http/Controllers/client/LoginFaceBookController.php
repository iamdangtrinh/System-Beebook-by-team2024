<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginFaceBookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            $findUser = User::where('facebook_id', $facebookUser->id)->where('status','active')->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect('/');
            }
            $user = User::where('email', $facebookUser->email)->first();
            if ($user) {
                // if status is inactive
                if ($user->status === 'inactive') {
                    session()->flash('errorSignIn','Tài khoản của bạn đã bị khóa !');
                     return redirect('/sign-in');
                }
                // else config
                $user->facebook_id = $facebookUser->id;
                $user->save();
                Auth::login($user);
                return redirect('/');

            }else{
                // create if don't have account
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'password' => Hash::make(Str::random(16)), // Đặt mật khẩu ngẫu nhiên
                ]);
                Auth::login($user);
                return redirect('/');
            }
        } catch (Exception $e) {
           return redirect('/login');
        }

    }
}
