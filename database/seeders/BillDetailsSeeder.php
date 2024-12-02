<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\BillModel;
use App\Models\Product;

class BillDetailsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        // Lấy danh sách ID và `updated_at` từ bảng bills
        $bills = BillModel::select('id', 'created_at', 'updated_at')->get();
        // Lấy danh sách ID từ bảng products
        $products = Product::pluck('id')->toArray();

        for ($i = 0; $i < 1000; $i++) { // Tạo 200 bản ghi
            // Chọn ngẫu nhiên một bill
            $randomBill = $bills->random();
            DB::table('bill_detail')->insert([
                'id_bill' => $randomBill->id, // ID bill ngẫu nhiên
                'id_product' => $faker->randomElement($products), // ID product ngẫu nhiên
                'quantity' => $faker->numberBetween(1, 10), // Số lượng sản phẩm (ngẫu nhiên từ 1 đến 10)
                'price' => $faker->randomFloat(2, 10, 500), // Giá sản phẩm (ngẫu nhiên từ 10 đến 500)
                'created_at' => $randomBill->created_at, // Thời gian tạo hiện tại
                'updated_at' => $randomBill->updated_at, // Lấy updated_at từ bill
            ]);
        }
    }
}