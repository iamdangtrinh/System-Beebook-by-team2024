<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;
use Livewire\Attributes\On;

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
    public $id_comment;
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
        $this->id_comment = $commentId;
        $this->dispatch('swal');
    }
    #[On('hanldeDeletedComment')]
    public function deleted()
    {
        $comment = Comment::find($this->id_comment);

        if ($comment && $comment->id_user == auth()->id()) {
            $comment->delete();
            $this->dispatch('toast', message: 'Xóa bình luận thành công.', notify: 'success');
        } else {
            $this->dispatch('toast', message: 'Xóa bình luận không thành công.', notify: 'error');
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
        $this->dispatch('toast', message: 'Thêm bình luận thành công.', notify: 'success');
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