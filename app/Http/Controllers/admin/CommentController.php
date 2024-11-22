<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $search = $request->input('search');

        // Truy vấn sản phẩm không phải trạng thái 'draft' và tìm kiếm theo tên sản phẩm
        $products = Product::where('status', '!=', 'draft')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->with(['comments' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Sắp xếp bình luận mới nhất
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Trả về view
        return view('admin.comment.index', compact('products', 'search'));
    }
    public function show($productId)
    {
        // Lấy thông tin sản phẩm kèm bình luận
        $product = Product::where('id', $productId)
            ->with(['comments' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Sắp xếp bình luận mới nhất
            }])
            ->firstOrFail();

        // Trả về view hiển thị chi tiết
        return view('admin.comment.show', compact('product'));
    }
}
