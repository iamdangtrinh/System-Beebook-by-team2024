<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\BlogModel;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function home()
    {
        $categories = CategoryProduct::get();
        $hotProducts = Product::where('status', 'active')->where('hot', 1)->inRandomOrder()->limit(4)->get();
        $saleProducts = Product::where('status', 'active')->whereNotNull('price_sale')->inRandomOrder()->limit(8)->get();
        $blogs = BlogModel::inRandomOrder()->limit(value: 8)->get();

        $bannerMain = BannerModel::where('type', '=', 'banner')->where('status', 'active')->get();
        $bannerSecondary = BannerModel::where('type', '=', 'secondaryBanner')->where('status', 'active')->limit(2)->orderBy('id','desc')->get();
        $thirdBanner = BannerModel::where('type', '=', 'thirdBanner')->where('status', 'active')->limit(2)->orderBy('id','desc')->get();

        return view('Client.home', compact([
            'hotProducts',
            'categories',
            'saleProducts',
            'blogs',
            'bannerMain',
            'bannerSecondary',
            'thirdBanner'
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
    public function contact()
    {
        return view('Client.contact');
    }
}
