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
        return view('Client.blog', compact('blogs'));
    }
    public function indexReview() {
        $blogs = BlogModel::where('post_type', 'review')->get();
        return view('Client.blog', compact('blogs'));
    }
    public function show($slug) {
        $getPost =  BlogModel::where('slug',$slug)->firstOrFail();
        if ($getPost['post_type'] === 'blog' ) {
            return view('Client.blogarticle',compact('getPost'));
        }else{
        $getProductByPost = PostProduct::where('id_post',$getPost['id'])->firstOrFail();
        $getProduct = Product::where('id',$getProductByPost['id_product'])->first();
            return view('Client.blogarticle',compact('getPost','getProduct'));
        }

    }
}
