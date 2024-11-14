<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Taxonomy;

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
            'language',
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
    public function add()
    {
        $authors = Taxonomy::where('type', 'author')->get();
        $translators = Taxonomy::where('type', 'translator')->get();
        $manufacturers = Taxonomy::where('type', 'manufacturer')->get();
        return view('admin.products.add', compact([
            'authors',
            'translators',
            'manufacturers',
        ]));
    }
}
