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

    public function selected()
    {
        return [
            'id',
            'post_type',
            'title',
            'views',
            'tags',
            'image',
            'slug',
            'status',
            'hot',
            'meta_title_seo',
            'meta_description_seo',
            'id_user',
            'created_at'
        ];
    }

    public function indexBlog(Request $request, $page = 1)
    {
        $titleHeading = 'Danh sách bản tin';
        $searchQuery = $request->input('q');

        $blogs = BlogModel::select($this->selected())
            ->where('post_type', 'blog')
            ->where('status', 'active');

        if (!empty($searchQuery)) {
            $blogs->where(function ($query) use ($searchQuery) {
                $query->where('tags', 'like', "%{$searchQuery}%")
                    ->orWhere('content', 'like', "%{$searchQuery}%")
                    ->orWhere('title', 'like', "%{$searchQuery}%");
            });
        }

        $blogs = $blogs->paginate(12);

        $getMostPost = BlogModel::select($this->selected())
            ->where('post_type', 'blog')->where('status', 'active')->orderBy('views', 'desc')->inRandomOrder()->limit(10)->get();
        $routeName = 'indexBlog';
        return view('Client.blog', compact('blogs', 'getMostPost', 'routeName', 'titleHeading'));
    }

    public function indexReview($page = 1)
    {
        $titleHeading = 'Review sách';
        $blogs = BlogModel::select($this->selected())
            ->where('post_type', 'review')
            ->where('status', 'active');
        if (!empty($searchQuery)) {
            $blogs->where(function ($query) use ($searchQuery) {
                $query->where('tags', 'like', "%{$searchQuery}%")
                    ->orWhere('content', 'like', "%{$searchQuery}%")
                    ->orWhere('title', 'like', "%{$searchQuery}%");
            });
        }
        $blogs = $blogs->paginate(12);
        $getMostPost = BlogModel::select($this->selected())
        ->where('post_type', 'review')->where('status', 'active')->orderBy('views', 'desc')->inRandomOrder()->limit(10)->get();
        $routeName = 'indexReview';
        return view('Client.blog', compact('blogs', 'getMostPost', 'routeName', 'titleHeading',));
    }

    public function show($slug)
    {
        $getPost =  BlogModel::where('slug', $slug)->firstOrFail();
        $getPostMore =  BlogModel::where('post_type', $getPost['post_type'])->where('status', 'active')->inRandomOrder()->limit(10)->get();
        $getMostPost =  BlogModel::where('post_type', $getPost['post_type'])->where('status', 'active')->orderBy('views', 'desc')->inRandomOrder()->limit(10)->get();
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

            $getProductByPost = PostProduct::where('id_post', $getPost['id'])->get(); // Lấy tất cả các bản ghi liên kết
            if ($getProductByPost->isNotEmpty()) {
                // Lấy tất cả các `id_product` từ `$getProductByPost` để truy vấn bảng `Product`
                $productIds = $getProductByPost->pluck('id_product'); // Lấy ra mảng các id_product
                $getProduct = Product::whereIn('id', $productIds)->get(); // Lấy tất cả các sản phẩm có id trong mảng $productIds
            } else {
                $getProduct = collect(); // Collection rỗng nếu không có sản phẩm nào
            }

            // return view('Client.blogarticle', compact('getPost', 'getProduct', 'getPostMore', 'getMostPost'));


            return view('Client.blogarticle', compact('getPost', 'getProduct', 'getPostMore', 'getMostPost'));
        }
    }
}
