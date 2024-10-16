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
        'type',
        'name',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
