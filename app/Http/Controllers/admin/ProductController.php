<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    protected function selected()
    {
        return [
            "id",
            "id_category",
            "name",
            "description",
            "slug",
            "quantity",
            "status",
            "url_video",
            "image_cover",
            "views",
            "price",
            "price_sale",
            "hot",
            "meta_seo",
            "description_seo",
            "created_at",
            "updated_at",
            "deleted_at",
            "id_author",
            "id_translator",
            "id_manufacturer"
        ];
    }

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.products.index', compact([
            'products',
        ]));
    }
}
