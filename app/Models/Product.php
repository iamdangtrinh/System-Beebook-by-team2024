<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_category',
        'name',
        'description',
        'slug',
        'quantity',
        'status',
        'url_video',
        'image_cover',
        'language',
        'views',
        'price',
        'price_sale',
        'hot',
        'year',
        'meta_seo',
        'description_seo',
        'created_at',
        'updated_at',
        'deleted_at',
        'id_author',
        'id_translator',
        'id_manufacturer'
    ];

    public function cart()
    {
        return $this->belongsTo(CartModel::class, 'id_product', 'id');
    }
    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'id_category', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_product', 'id');
    }
    public function billDetails()
    {
        return $this->hasMany(BillDetailModel::class, 'id_product', 'id');
    }
    public function countComments()
    {
        return $this->comments()->count(); // Đếm số bình luận
    }

    public function averageRating()
    {
        return $this->comments()->avg('rating'); // Tính trung bình rating
    }
    public function author()
    {
        return $this->belongsTo(Taxonomy::class, 'id_author', 'id');
    }
    public function translator()
    {
        return $this->belongsTo(Taxonomy::class, 'id_translator', 'id');
    }
    public function manufacturer()
    {
        return $this->belongsTo(Taxonomy::class, 'id_manufacturer', 'id');
    }
    public function isFavoritedByUser()
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        return $user->favorite()->where('id_product', $this->id)->exists();
    }
    public function metas()
    {
        return $this->hasMany(ProductMeta::class, 'id_product', 'id');
    }
}
