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
        $title = 'Cửa hàng';
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
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
            'title',
        ]));
    }
    public function hot()
    {
        $title = 'Sản phẩm nổi bật';
        $products = Product::where('hot', 1)->orderBy('created_at', 'desc')->paginate(12);
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
            'title',
        ]));
    }
    public function category($slug)
    {
        $category = CategoryProduct::where('slug', $slug)->firstOrFail();
        $title = 'Danh mục: ' . $category->name;
        $categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        // Lấy tất cả danh mục con của danh mục cha
        $childCategories = $category->children->pluck('id');

        // Thêm ID của danh mục cha vào danh sách ID
        $categoryIds = $childCategories->push($category->id);

        // Lấy sản phẩm từ cả danh mục cha và danh mục con, sắp xếp theo ngày tạo
        $products = Product::whereIn('id_category', $categoryIds)->orderBy('created_at', 'desc')->paginate(12);
        $totalProducts = $products->count();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        return view('Client.shop', compact([
            'category',
            'products',
            'totalProducts',
            'hotProducts',
            'categories',
            'title',
        ]));
    }
    public function author($slug)
    {
        $author = Taxonomy::where('slug', $slug)->firstOrFail();
        $title = 'Tác giả: ' . $author->name;
        $categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        $products = Product::where('id_author', $author->id)->orderBy('created_at', 'desc')->paginate(12);
        $totalProducts = $products->count();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        return view('Client.shop', compact([
            'author',
            'products',
            'totalProducts',
            'hotProducts',
            'categories',
            'title',
        ]));
    }
    public function manufacturer($slug)
    {
        $manufacturer = Taxonomy::where('slug', $slug)->firstOrFail();
        $title = $manufacturer->name;
        $categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        $products = Product::where('id_manufacturer', $manufacturer->id)->orderBy('created_at', 'desc')->paginate(12);
        $totalProducts = $products->count();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        return view('Client.shop', compact([
            'manufacturer',
            'products',
            'totalProducts',
            'hotProducts',
            'categories',
            'title',
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
    public function filter(Request $request)
    {
        $query = Product::query();

        // Lọc theo khoảng giá
        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        // Lọc theo ngôn ngữ
        if ($request->has('languages')) {
            $query->whereIn('language', $request->languages);
        }
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'bestseller':
                    $query->orderBy('sales_count', 'desc'); // Sắp xếp theo số lượng bán chạy
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc'); // Sắp xếp sản phẩm mới nhất
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc'); // Sắp xếp sản phẩm cũ nhất
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc'); // Sắp xếp giá cao tới thấp
                    break;
                case 'price-asc':
                    $query->orderBy('price', 'asc'); // Sắp xếp giá thấp tới cao
                    break;
                default:
                    $query->orderBy('created_at', 'desc'); // Mặc định sắp xếp
            }
        }

        $products = $query->paginate(12);

        return view('Client.shop', compact('products'))->render();
    }
}
