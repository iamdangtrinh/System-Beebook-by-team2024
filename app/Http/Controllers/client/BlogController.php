<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use App\Models\PostProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        $blog = BlogModel::where('post_type', 'blog')->limit(1);

        // Lấy một bài viết review
        $review = BlogModel::where('post_type', 'review')->limit(1);
        
        // Kết hợp cả hai truy vấn
        $blogs = $blog->union($review)->get();
        // Truyền dữ liệu sang view
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
