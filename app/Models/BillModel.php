<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillModel extends Model
{
    use HasFactory;

    protected $table = 'bills';
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "id_user",
        "status",
        "reason_cancel",
        "total_amount",
        "payment_method",
        "payment_status",
        "shipping_method",
        "discount",
        "fee_shipping",
        "address",
        "email",
        "phone",
        "name",
        "note",
        "note_admin",
    ];
}
