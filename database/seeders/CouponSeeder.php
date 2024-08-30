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
        $couponTypes = ['percent', 'amount']; // 'percent' = Percentage, 'amount' = Fixed Amount
        $statuses = ['active', 'inactive', 'expired'];

        // Define the number of coupons to create
        $numberOfCoupons = 100;

        for ($i = 0; $i < $numberOfCoupons; $i++) {
            $codeCoupon = strtoupper(Str::random(10));
            $expiresAt = now()->addDays(rand(15, 90));
            $typeCoupon = Arr::random($couponTypes);
            $quantity = rand(1, 100);
            $status = Arr::random($statuses);
            $couponMinSpend = rand(10000, 50000); // Random minimum spend between 10k and 50k
            $couponMaxSpend = $couponMinSpend + rand(50000, 200000); // Random max spend higher than min spend

            // Determine the discount value based on the coupon type
            if ($typeCoupon === 'percent') {
                // Percentage discount
                $discount = rand(5, 30); // Random percentage between 5% and 30%
                $description = "Giảm " . $discount . "% áp dụng cho toàn bộ sản phẩm";
            } else {
                // Fixed amount discount
                $discount = rand(5000, 50000); // Random fixed amount between 5k and 50k
                $description = "Giảm " . number_format($discount, 0, ',', '.') . "đ áp dụng cho toàn bộ sản phẩm";
            }

            DB::table('coupons')->insert([
                'code_coupon' => $codeCoupon,
                'description' => $description,
                'start_date' => now(),
                'expires_at' => $expiresAt,
                'coupon_min_spend' => $couponMinSpend,
                'coupon_max_spend' => $couponMaxSpend,
                'discount' => $discount,
                'coupon_uses_per_customer' => rand(1, 5), // Random number of uses per customer between 1 and 5
                'type_coupon' => $typeCoupon,
                'quantity' => $quantity,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
