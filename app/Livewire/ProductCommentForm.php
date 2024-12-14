<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;

class ProductCommentForm extends Component
{
    #[Validate('required', message: 'Vui lòng nhập nội dung bình luận')]
    #[Validate('max:500', message: 'Bình luận không được quá 500 ký tự')]
    #[Validate('required', message: 'Vui lòng chọn một đánh giá')]
    public $title = '';
    public $showRate = 0;
    public $id_product;
    public $slug_product;
    public $id_user;
    public $comments = [];

    public function mount($idProduct, $slugProduct)
    {
        $this->id_product = $idProduct;
        $this->slug_product = $slugProduct;
        $this->id_user = auth()->id();
        $this->fetchComments();
    }

    // Xóa bình luận
    public function deleteComment($commentId)
    {
        // Kiểm tra xem người dùng có phải là người đã đăng bình luận không
        $comment = Comment::find($commentId);

        if ($comment && $comment->id_user == auth()->id()) {
            $comment->delete();
            session()->flash('success', 'Bình luận đã được xóa thành công.');
        } else {
            session()->flash('error', 'Bạn không có quyền xóa bình luận này.');
        }

        // Tải lại danh sách bình luận sau khi xóa
        $this->fetchComments();
    }

    public function rating($value)
    {
        $this->showRate = $value;
    }

    public function title($value)
    {
        $this->title = $value;
    }
    public function postComment()
    {
        if (!auth()->check()) {
            session()->flash('error', 'Vui lòng đăng nhập để bình luận!');
            return redirect('/sign-in');
        }

        $this->validate();

        Comment::create([
            'id_product' => $this->id_product,
            'id_user' => auth()->id(),
            'rating' => $this->showRate,
            'content' => $this->title,
        ]);

        $this->reset(['showRate', 'title']);
        $this->fetchComments();
    }


    public function fetchComments()
    {
        $this->comments = Comment::where('id_product', $this->id_product)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.product-comment-form');
    }
}
