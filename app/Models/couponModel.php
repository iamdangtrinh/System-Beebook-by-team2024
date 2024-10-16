<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class couponModel extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "code_coupon",
        "description",
        "start_date",
        "expires_at",
        "coupon_min_spend",
        "coupon_max_spend",
        "discount",
        "type_coupon",
        "quantity",
        "status",
        "created_at",
        "updated_at",
    ];
}
