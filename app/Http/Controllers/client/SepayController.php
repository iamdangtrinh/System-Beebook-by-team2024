<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SepayController extends Controller
{
    public function webhook() {
        Mail::raw('hello Sepaycontroller custom hook successfuly', function ($message) {
            $message->to('dtrinhit84@gmail.com')
                    ->subject('Hello Email');
        });
    }
}
