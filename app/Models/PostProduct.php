<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostProduct extends Model
{
    use HasFactory;
    protected $table = 'post_product';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_post',
        'id_product',
        'created_at',
        'updated_at',
    ];
}
