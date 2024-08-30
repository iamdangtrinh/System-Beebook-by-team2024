<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_image',
        'id_category',
        'name',
        'description',
        'slug',
        'sold',
        'quantity',
        'status',
        'url_video',
        'image_cover',
        'views',
        'price',
        'price_sale',
        'hot',
        'start_sale',
        'end_sale',
        'meta_seo',
        'description_seo',
        'created_at',
        'updated_at',
        'deleted_at',
        'author',
        'publisher',
        'manufacturer'
    ];

    public function cart()
    {
        return $this->belongsTo(CartModel::class, 'id_product', 'id');
    }
}
