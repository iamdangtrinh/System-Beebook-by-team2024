<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BillModel extends Model
{
    use HasFactory;

    protected $table = 'bills';
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "id_coupon",
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

    public function billDetails()
    {
        // return $this->hasMany(BillDetailModel::class, 'id_bill', 'id');
        return $this->hasManyThrough(
            Product::class,
            BillDetailModel::class,
            'id_bill',       // Khóa ngoại trong bảng BillDetail trỏ đến Bill
            'id',            // Khóa chính trong bảng Product
            'id',            // Khóa chính trong bảng Bill
            'id_product'     // Khóa ngoại trong bảng BillDetail trỏ đến Product
        )->select(
            'products.id',
            'products.name',
            'products.price',
            'products.image_cover',
            'products.slug',
            'bill_detail.quantity'
        );
    }

    public function billUser()
    {
        return $this->hasOne(User::class, 'id', 'id_user')->select(['id', 'name', 'phone', 'email', 'address', 'avatar']);
    }
    public function Coupon()
    {
        return $this->hasOne(couponModel::class, 'id', 'id_coupon')->select(['*']);
    }
}
