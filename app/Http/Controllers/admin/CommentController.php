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

        // Truy vấn sản phẩm không phải trạng thái 'draft', tìm kiếm theo tên và sắp xếp theo số lượng bình luận
        $products = Product::where('status', '!=', 'draft')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->withCount('comments') // Đếm số lượng bình luận
            ->orderBy('comments_count', 'desc') // Sắp xếp theo số lượng bình luận từ nhiều tới ít
            ->paginate(12);

        // Trả về view
        return view('admin.comment.index', compact('products', 'search'));
    }

    public function show($productId)
    {
        // Lấy sản phẩm
        $product = Product::findOrFail($productId);

        // Lấy bình luận với phân trang
        $comments = $product->comments()->orderBy('created_at', 'desc')->paginate(10);

        // Trả về view
        return view('admin.comment.show', compact('product', 'comments'));
    }
    public function destroy($commentId)
    {
        // Tìm bình luận theo ID
        $comment = Comment::findOrFail($commentId);

        // Xóa bình luận
        $comment->delete();

        // Chuyển hướng lại trang trước đó với thông báo thành công
        return redirect()->back()->with('success', 'Bình luận đã được xóa thành công.');
    }
}
