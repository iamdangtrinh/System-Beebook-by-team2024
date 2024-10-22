<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = 'categories_product';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'image',
        'slug',
        'status',
        'order',
        'parent_id',
        'created_at',
        'updated_at',
    ];

    // Mối quan hệ với danh mục con
    public function children()
    {
        return $this->hasMany(CategoryProduct::class, 'parent_id');
    }
}
