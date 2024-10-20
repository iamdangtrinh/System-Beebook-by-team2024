<?php

namespace App\Livewire;

use Livewire\Attributes\Validate; 
use Livewire\Component;
use App\Models\Comment;

class ProductCommentForm extends Component
{
    #[Validate('required',message:'Vui lòng chọn một đánh giá')] 
    public $rating;

    #[Validate('required',message:'Vui lòng nhập nội dung bình luận')] 
    #[Validate('max:500',message:'Bình luận không được quá 500 ký tự')] 
    public $content;

    public $id_product;
    public $id_user;

    public function mount($idProduct)
    {
        $this->id_product = $idProduct;
        $this->id_user = 1;
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

        // Reset form fields
        $this->reset(['rating', 'content']);

        $this->dispatchBrowserEvent('toast', ['message' => 'Bình luận thành công']);
    }
    public function render()
    {
        return view('livewire.product-comment-form');
    }
}
