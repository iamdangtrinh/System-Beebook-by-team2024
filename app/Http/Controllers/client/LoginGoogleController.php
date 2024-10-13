<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginGoogleController extends Controller
{
    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();

    }
    public function handleGoogleCallback()
    {
        try {
            // get user by google
            $googleUser = Socialite::driver('google')->user();
            // find user where google_id and status
            $findUser = User::where('google_id', $googleUser->id)->where('status','active')->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect('/');
            }
            // get user where email
            $user = User::where('email', $googleUser->email)->first();
            if ($user) {
                // if status is inactive
                if ($user->status === 'inactive') {
                    session()->flash('errorSignIn','Tài khoản của bạn đã bị khóa !');
                     return redirect('/sign-in');
                }
                // else config
                $user->google_id = $googleUser->id;
                $user->save();
                Auth::login($user);
            return redirect('/');
            }else{
                // create if don't have account
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(16)), // Đặt mật khẩu ngẫu nhiên
                ]);
                Auth::login($user);
            return redirect('/');
            }
            
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

}
