<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class CategoryProductSeeder extends Seeder
{
    protected $bookCategories = [
        'Tiểu thuyết',
        'Khoa học viễn tưởng',
        'Lịch sử',
        'Kinh tế',
        'Tự lực',
        'Kinh điển',
        'Huyền bí',
        'Triết học',
        'Chuyên ngành',
        'Tình cảm',
        'Phiêu lưu',
        'Sách học thuật',
        'Giáo dục',
        'Tâm lý học',
        'Kỹ năng sống',
        'Nấu ăn',
        'Hướng dẫn',
        'Châm biếm',
        'Sách thiếu nhi',
        'Tự truyện',
        'Sách tranh'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['active', 'inactive'];

        for ($i = 0; $i < count($this->bookCategories); $i++) {
            $name = $this->bookCategories[$i];
            $slug = Str::slug($name);
            $status = Arr::random($statuses);
            $order = $i + 1;
            $parent_id = $i > 0 ? rand(1, $i) : null; // Giả sử các danh mục đã có từ 1 đến i, chọn parent_id từ những danh mục trước đó hoặc null

            DB::table('categories_product')->insert([
                'name' => $name,
                'image' => 'images/' . Str::random(10) . '.jpg', // Tạo tên file hình ảnh ngẫu nhiên
                'slug' => $slug,
                'status' => $status,
                'order' => $order,
                'parent_id' => $parent_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
