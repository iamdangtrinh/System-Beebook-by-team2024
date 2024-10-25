<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\Comment;
use App\Models\CategoryProduct;
use App\Models\Taxonomy;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        $totalProducts = $products->count();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        return view('Client.shop', compact([
            'products',
            'totalProducts',
            'hotProducts',
            'categories',
        ]));
    }
    public function hot()
    {
        $products = Product::where('hot', 1)->get();
        $categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        $totalProducts = $products->count();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        return view('Client.shop', compact([
            'products',
            'totalProducts',
            'hotProducts',
            'categories',
        ]));
    }
    public function category($slug)
    {
        $category = CategoryProduct::where('slug', $slug)->firstOrFail();
        $categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        $products = Product::where('id_category', $category->id)->get();
        $totalProducts = $products->count();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        return view('Client.shop', compact([
            'category',
            'products',
            'totalProducts',
            'hotProducts',
            'categories',
        ]));
    }
    public function author($slug)
    {
        $author = Taxonomy::where('slug', $slug)->firstOrFail();
        $categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        $products = Product::where('id_author', $author->id)->get();
        $totalProducts = $products->count();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        return view('Client.shop', compact([
            'author',
            'products',
            'totalProducts',
            'hotProducts',
            'categories',
        ]));
    }
    public function manufacturer($slug)
    {
        $manufacturer = Taxonomy::where('slug', $slug)->firstOrFail();
        $categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        $products = Product::where('id_manufacturer', $manufacturer->id)->get();
        $totalProducts = $products->count();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        return view('Client.shop', compact([
            'manufacturer',
            'products',
            'totalProducts',
            'hotProducts',
            'categories',
        ]));
    }
    public function detail($slug)
    {
        $product = Product::with('author', 'translator', 'manufacturer')->where('slug', $slug)->firstOrFail();
        $product_meta = ProductMeta::where('id_product', $product->id)->get();
        $product_same = Product::where('id_category', $product->id_category)->inRandomOrder()->limit(4)->get();
        $comments = Comment::where('id_product', $product->id)->latest()->get();
        $commentCount = $product->countComments(); // Đếm số bình luận
        $averageRating = $product->averageRating(); // Tính trung bình rating
        return view('Client.productdetail', compact([
            'product',
            'product_meta',
            'product_same',
            'comments',
            'commentCount',
            'averageRating',
        ]));
    }
}
