<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function toggle($idproduct)
    {
        $user = auth()->user();

        // Kiểm tra sản phẩm đã có trong danh sách yêu thích hay chưa
        $favorite = Favorite::where('id_user', $user->id)
            ->where('id_product', $idproduct)
            ->first();

        if ($favorite) {
            // Xóa sản phẩm khỏi danh sách yêu thích
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // Thêm sản phẩm vào danh sách yêu thích
            Favorite::create([
                'id_user' => $user->id,
                'id_product' => $idproduct
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function getWishlist()
    {
        if (!auth()->check()) {
            session()->flash('error', 'Vui lòng đăng nhập để xem sản phẩm vào yêu thích !');
            return redirect('/sign-in');
        }

        $products = Favorite::where('id_user', auth()->id())->with('product')->paginate(12);
        $title = 'Yêu thích';
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
}
