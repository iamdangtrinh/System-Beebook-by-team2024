<?php

namespace App\Http\Controllers\client;;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        //
    }
    public function add(CommentRequest $request)
    {
        $comment = new Comment();
        $comment->rating = $request->input('rating');
        $comment->content = $request->input('content');
        $comment->id_user = 1;
        $comment->id_product = $request->input('id_product');

        $comment->save();

        return redirect()->back()->with('success', 'Bình luận đã được gửi!');
    }
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['success' => false, 'message' => 'Bình luận không tồn tại.']);
        }

        if (Auth::id() !== $comment->user_id) {
            return response()->json(['success' => false, 'message' => 'Bạn không có quyền xóa bình luận này.']);
        }

        $comment->delete();

        return response()->json(['success' => true, 'message' => 'Bình luận đã được xóa.']);
    }
}
