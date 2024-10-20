<?php
namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\Comment;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //
    }
    public function detail($slug)
    {
        $product = Product::with('author', 'publisher', 'manufacturer')->where('slug', $slug)->firstOrFail();
        $product_meta = ProductMeta::where('id_product', $product->id)->get();
        $product_same = Product::where('id_category', $product->id_category)->inRandomOrder()->limit(4)->get();
        $comments = Comment::where('id_product', $product->id)->orderBy('created_at', 'desc')->get();;
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
