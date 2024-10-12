<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;
    protected $table = 'productmeta';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_product',
        'product_key',
        'product_value',
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
