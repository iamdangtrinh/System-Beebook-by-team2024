<?php

namespace App\Models;
namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //
    }
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        dd($product);
        return view('Client.productdetail', compact([
            'product'
        ]));
    }
}
