<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'posts';
    protected $fillable = [
        'id',
        'post_type',
        'title',
        'content',
        'views',
        'tags',
        'image',
        'slug',
        'status',
        'hot',
        'meta_title_seo',
        'meta_description_seo',
        'id_user',
    ];

    // Phương thức để tăng lượt xem
    public function incrementViews()
    {
        $this->increment('views');
    }
}
