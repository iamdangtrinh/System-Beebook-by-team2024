<?php

namespace App\Livewire;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;

class ProductCommentForm extends Component
{
    #[Validate('required',message:'Vui lòng chọn một đánh giá')] 
    public $rating;

    #[Validate('required',message:'Vui lòng nhập nội dung bình luận')] 
    #[Validate('max:500',message:'Bình luận không được quá 500 ký tự')] 
    public $content;

    public $id_product;
    public $slug_product;
    public $id_user;
    public $comments = [];

    public function mount($idProduct,$slugProduct)
    {
        $this->id_product = $idProduct;
        $this->slug_product = $slugProduct;
        $this->id_user = 1;
        $this->fetchComments();
    }

    public function submit()
    {
        $this->validate();

        Comment::create([
            'id_product' => $this->id_product,
            'id_user' => $this->id_user,
            'rating' => $this->rating,
            'content' => $this->content,
        ]);
        Session::flash('comment_success', 'Bình luận thành công!');

        // Fetch the latest comments after submitting
        $this->fetchComments();

        // Reset form fields
        $this->reset(['rating', 'content']);
    }

    public function fetchComments()
    {
        // Fetch comments from the database
        $this->comments = Comment::where('id_product', $this->id_product)
                                  ->latest()
                                  ->get();
    }

    public function render()
    {
        return view('livewire.product-comment-form');
    }
}
