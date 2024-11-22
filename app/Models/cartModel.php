<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class cartModel extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'id_product',
        'price',
        'quantity',
    ];

    public function cartProduct() {
        return $this->belongsToMany(Product::class, 'carts', 'id', 'id_product')->where('status', 'active');
    }

}
