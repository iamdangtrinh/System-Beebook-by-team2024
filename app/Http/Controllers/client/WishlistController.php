<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        if (!auth()->check()) {
            session()->flash('errorSignIn','Vui lòng đăng nhập để thêm sản phẩm vào yêu thích !');
            return redirect('/sign-in');
        }

        $wishlist = Favorite::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $request->product_id],
            []
        );

        return response()->json(['message' => 'Product added to wishlist successfully.']);
    }

    public function remove(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Please log in to remove products from your wishlist.'], 401);
        }

        Favorite::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->delete();

        return response()->json(['message' => 'Product removed from wishlist successfully.']);
    }

    public function getWishlist()
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Please log in to view your wishlist.'], 401);
        }

        $wishlistItems = Favorite::where('user_id', auth()->id())->with('product')->get();

        return response()->json($wishlistItems);
    }
}
