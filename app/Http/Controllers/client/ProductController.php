<?php

namespace App\Http\Controllers;
namespace App\Models\productModel;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug)
    {
        $product = productModel::where('slug', $slug)->firstOrFail();;
        return view('Client.productdetail', compact([
            'product'
        ]));
    }
}
