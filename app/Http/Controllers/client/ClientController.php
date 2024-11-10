<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function home()
    {
        $categories = CategoryProduct::get();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        $saleProducts = Product::whereNotNull('price_sale')->inRandomOrder()->limit(8)->get();
        $blogs = BlogModel::inRandomOrder()->limit(value: 8)->get();
        return view('Client.home', data: compact([
            'hotProducts',
            'categories',
            'saleProducts',
            'blogs'
        ]));
    }
    public function shop()
    {
        return view('Client.shop');
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
