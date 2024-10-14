<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_product',
        'id_user',
        'rating',
        'content',
        'created_at',
        'updated_at',
    ];

    public function Product() {
        return $this->belongsTo(Product::class,'id_product', 'id');
    }
}
