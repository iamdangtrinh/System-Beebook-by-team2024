<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function home()
    {
        return view('Client.home');
    }
    public function shop()
    {
        return view('Client.shop');
    }
    public function cart()
    {
        return view('Client.cart');
    }
    public function blog()
    {
        return view('Client.blog');
    }
    public function blogarticle()
    {
        return view('Client.blogarticle');
    }
    public function bloggridview()
    {
        return view('Client.bloggridview');
    }
    public function productshippingmessage()
    {
        return view('Client.productshippingmessage');
    }
    public function shortdescription()
    {
        return view('Client.shortdescription');
    }
}
