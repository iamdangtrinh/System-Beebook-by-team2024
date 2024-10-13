<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetailModel extends Model
{
    use HasFactory;
    protected $table = 'bill_detail';
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "id_product",
        "id_bill",
        "name",
        "image_cover",
        "quantity",
        "price",
    ];

}
