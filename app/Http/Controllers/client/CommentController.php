<?php

namespace App\Http\Controllers\client;;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

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
}
