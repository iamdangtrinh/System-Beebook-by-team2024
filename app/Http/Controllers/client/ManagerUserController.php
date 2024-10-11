<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SignInRequest;

class ManagerUserController extends Controller
{
    public function SignIn(){
        return view('Client.signIn' );
    }
    public function SignUp(){
        return view('client.SignUp');
    }
}
