<?php

namespace App\Models;
namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductMeta;

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
        $product_meta = ProductMeta::where('id_product', $product->id)->get();
        return view('Client.productdetail', compact([
            'product',
            'product_meta'
        ]));
    }
}
