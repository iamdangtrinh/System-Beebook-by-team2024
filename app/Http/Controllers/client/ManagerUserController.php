<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManagerUserController extends Controller
{
    public function SignIn(){
        return view('Client.signIn' );
    }
    public function SignUp(){
        return view('client.signUp');
    }
    public function  LogOut() {
        Auth::logout();
        return redirect('/sign-in');
    }
}
