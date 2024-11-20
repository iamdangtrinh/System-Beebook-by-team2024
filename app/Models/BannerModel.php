<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    use HasFactory;
    protected $table = 'banner';
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "image",
        "type",
        "text_link",
        "order",
        "status",
        "created_at",
        "updated_at",
    ];
}
