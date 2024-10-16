<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ManagerUserController extends Controller
{
    public function SignIn(){
        return view('Client.signIn' );
    }
    public function SignUp(){
        return view('Client.signUp');
    }
    public function  LogOut() {
        Auth::logout();
        return redirect('/sign-in');
    }
    public function Profile(){
        return view('Client.profile')->with('success','hello');
    }
}
