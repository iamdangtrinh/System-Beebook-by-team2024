<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define coupon types
        $couponTypes = [1, 2]; // 1 = Percentage, 2 = Fixed Amount
        $statuses = ['active', 'inactive'];

        // Define the number of coupons to create
        $numberOfCoupons = 100;

        for ($i = 0; $i < $numberOfCoupons; $i++) {
            $codeCoupon = strtoupper(Str::random(10));
            $description = "Mã giảm " . rand(5, 30) . "% áp dụng cho toàn bộ sản phẩm";
            $expiresAt = now()->addDays(rand(15, 90));
            $discount = rand(5000, 100000); // Random discount value
            $typeCoupon = Arr::random($couponTypes);
            $quantity = rand(1, 100);
            $status = Arr::random($statuses);

            DB::table('coupons')->insert([
                'code_coupon' => $codeCoupon,
                'description' => $description,
                'expires_at' => $expiresAt,
                'discount' => $discount,
                'type_coupon' => $typeCoupon,
                'quantity' => $quantity,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
