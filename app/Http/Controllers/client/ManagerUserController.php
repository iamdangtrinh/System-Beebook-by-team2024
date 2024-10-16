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
    // verify sign up 
    public function HandleVerifySignUp($id){
       try {
        User::where('id',$id)->update([
            'email_verified_at' => now(),
            'status' => 'active' 
        ]);
        redirect('/sign-in');
    } catch (\Throwable $th) {
        //throw $th;
        dd('Không xác nhận được');
       }
    }
}
