<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use App\Models\PostProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function indexBlog() {
        $blogs = BlogModel::where('post_type', 'blog')->get();
        $getMostPost = BlogModel::where('post_type', 'blog')->orderBy('views', 'desc')->inRandomOrder()->limit(4)->get();
    
        return view('Client.blog', compact('blogs', 'getMostPost'));
    }
    
    public function indexReview() {
        $blogs = BlogModel::where('post_type', 'review')->get();
        $getMostPost = BlogModel::where('post_type', 'review')->orderBy('views', 'desc')->inRandomOrder()->limit(4)->get();
    
        return view('Client.blog', compact('blogs', 'getMostPost'));
    }
    
    public function show($slug) {
        $getPost = BlogModel::where('slug', $slug)->firstOrFail();
        $getPostMore = BlogModel::where('post_type', $getPost['post_type'])->inRandomOrder()->limit(4)->get();
        $getMostPost = BlogModel::where('post_type', $getPost['post_type'])->orderBy('views', 'desc')->inRandomOrder()->limit(4)->get();
    
        if ($getPost['post_type'] === 'blog') {
            $getProduct = [];
        } else {
            $getProductByPost = PostProduct::where('id_post', $getPost['id'])->firstOrFail();
            $getProduct = Product::where('id', $getProductByPost['id_product'])->first();
        }
    
        return view('Client.blogarticle', compact('getPost', 'getProduct', 'getPostMore', 'getMostPost'));
    }
    
}
