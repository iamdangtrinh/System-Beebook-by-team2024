<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use App\Models\PostProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BlogController extends Controller
{
    public function indexBlog($page = 1)
    {
        $blogs = BlogModel::where('post_type', 'blog')->paginate(12, ['*'], 'page', $page);

        // Thêm vớiPath() để đảm bảo đường dẫn đúng
        // $blogs->withPath(route('indexBlog'))->appends(request()->query());
        $titleHeading = 'Danh sách bản tin';
        $getMostPost = BlogModel::where('post_type', 'blog')->orderBy('views', 'desc')->inRandomOrder()->limit(4)->get();
        $routeName = 'indexBlog';

        return view('Client.blog', compact('blogs', 'getMostPost', 'routeName', 'titleHeading'));
    }

    public function indexReview($page = 1)
    {
        $blogs = BlogModel::where('post_type', 'review')->paginate(12, ['*'], 'page', $page);

        // Thêm vớiPath() để đảm bảo đường dẫn đúng
        // $blogs->withPath(route('indexReview'))->appends(request()->query());
        $titleHeading = 'Review sách';
        $getMostPost = BlogModel::where('post_type', 'review')->orderBy('views', 'desc')->inRandomOrder()->limit(4)->get();
        $routeName = 'indexReview';

        return view('Client.blog', compact('blogs', 'getMostPost', 'routeName', 'titleHeading'));
    }

    public function show($slug)
    {
        $getPost =  BlogModel::where('slug', $slug)->firstOrFail();
        $getPostMore =  BlogModel::where('post_type', $getPost['post_type'])->inRandomOrder()->limit(4)->get();
        $getMostPost =  BlogModel::where('post_type', $getPost['post_type'])->orderBy('views', 'desc')->inRandomOrder()->limit(4)->get();
        if (Auth::user()) {

            $time = Carbon::parse(Auth::user()->email_verified_at);
            if (!$time->isToday() && !Carbon::now()->diffInMinutes($time) < 5) {
                User::where('id', Auth::user()->id)->update(['email_verified_at' => Carbon::now()]);
                BlogModel::where('id', $getPost->id)->increment('views');
            }
        }
        if ($getPost['post_type'] === 'blog') {
            $getProduct = [];
            return view('Client.blogarticle', compact('getPost', 'getProduct', 'getPostMore', 'getMostPost'));
        } else {

            $getProductByPost = PostProduct::where('id_post', $getPost['id'])->get();
            $getProduct = Product::where('id', $getProductByPost['id_product'])->get();
            return view('Client.blogarticle', compact('getPost', 'getProduct', 'getPostMore', 'getMostPost'));
        }
    }
}
