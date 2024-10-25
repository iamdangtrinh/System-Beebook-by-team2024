<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy tất cả id_product từ bảng products
        $productIds = DB::table('products')->pluck('id'); // Lấy tất cả id_product

        // Lấy tất cả id_post từ bảng posts có type là review
        $reviewPostIds = DB::table('posts')->where('post_type', 'review')->pluck('id');

        // Tạo 100 bản ghi trong bảng post_product
        for ($i = 1; $i <= 100; $i++) {
            DB::table('post_product')->insert([
                'id_post' => $reviewPostIds->random(), // Chọn ngẫu nhiên id_post từ danh sách review
                'id_product' => $productIds->random(), // Chọn ngẫu nhiên id_product từ danh sách
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
