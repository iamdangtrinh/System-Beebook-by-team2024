<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tiểu thuyết', 'image' => 'images/n3FUWQuqBd.jpg', 'slug' => 'tieu-thuyet', 'status' => 'active', 'order' => 1, 'parent_id' => null],
            ['name' => 'Khoa học viễn tưởng', 'image' => 'images/hMfUSiX7P8.jpg', 'slug' => 'khoa-hoc-vien-tuong', 'status' => 'active', 'order' => 2, 'parent_id' => null],
            ['name' => 'Lịch sử', 'image' => 'images/ftyJ2RL1vH.jpg', 'slug' => 'lich-su', 'status' => 'active', 'order' => 3, 'parent_id' => null],
            ['name' => 'Kinh tế', 'image' => 'images/jdW2H53ZeA.jpg', 'slug' => 'kinh-te', 'status' => 'active', 'order' => 4, 'parent_id' => null],
            ['name' => 'Tự lực', 'image' => 'images/9484G486oi.jpg', 'slug' => 'tu-luc', 'status' => 'active', 'order' => 5, 'parent_id' => 1],
            ['name' => 'Kinh điển', 'image' => 'images/YSg3hSZOo4.jpg', 'slug' => 'kinh-dien', 'status' => 'active', 'order' => 6, 'parent_id' => 2],
            ['name' => 'Huyền bí', 'image' => 'images/iazow7iT7i.jpg', 'slug' => 'huyen-bi', 'status' => 'active', 'order' => 7, 'parent_id' => 1],
            ['name' => 'Triết học', 'image' => 'images/wHcIChIxqo.jpg', 'slug' => 'triet-hoc', 'status' => 'active', 'order' => 8, 'parent_id' => null],
            ['name' => 'Chuyên ngành', 'image' => 'images/09vKX5RcVv.jpg', 'slug' => 'chuyen-nganh', 'status' => 'active', 'order' => 9, 'parent_id' => null],
            ['name' => 'Tình cảm', 'image' => 'images/1eIJ3XeRbp.jpg', 'slug' => 'tinh-cam', 'status' => 'active', 'order' => 10, 'parent_id' => null],
            ['name' => 'Phiêu lưu', 'image' => 'images/U4Xg0WR3u9.jpg', 'slug' => 'phieu-luu', 'status' => 'active', 'order' => 11, 'parent_id' => 2],
            ['name' => 'Sách học thuật', 'image' => 'images/dVcOWNxhfV.jpg', 'slug' => 'sach-hoc-thuat', 'status' => 'active', 'order' => 12, 'parent_id' => 9],
            ['name' => 'Giáo dục', 'image' => 'images/It0disf3v6.jpg', 'slug' => 'giao-duc', 'status' => 'active', 'order' => 13, 'parent_id' => null],
            ['name' => 'Tâm lý học', 'image' => 'images/NmIWFY02wa.jpg', 'slug' => 'tam-ly-hoc', 'status' => 'active', 'order' => 14, 'parent_id' => 13],
            ['name' => 'Kỹ năng sống', 'image' => 'images/u5lk2d7Zxq.jpg', 'slug' => 'ky-nang-song', 'status' => 'active', 'order' => 15, 'parent_id' => 13],
            ['name' => 'Nấu ăn', 'image' => 'images/Pfv2h0YS95.jpg', 'slug' => 'nau-an', 'status' => 'active', 'order' => 16, 'parent_id' => 13],
            ['name' => 'Hướng dẫn', 'image' => 'images/erPZsa0inf.jpg', 'slug' => 'huong-dan', 'status' => 'active', 'order' => 17, 'parent_id' => 13],
            ['name' => 'Châm biếm', 'image' => 'images/n2jN5s9vBj.jpg', 'slug' => 'cham-biem', 'status' => 'inactive', 'order' => 18, 'parent_id' => 1],
            ['name' => 'Sách thiếu nhi', 'image' => 'images/x2jYqzBxwl.jpg', 'slug' => 'sach-thieu-nhi', 'status' => 'active', 'order' => 19, 'parent_id' => null],
            ['name' => 'Tự truyện', 'image' => 'images/wYWkD46eFb.jpg', 'slug' => 'tu-truyen', 'status' => 'active', 'order' => 20, 'parent_id' => 19],
            ['name' => 'Sách tranh', 'image' => 'images/FWvYJb2t19.jpg', 'slug' => 'sach-tranh', 'status' => 'active', 'order' => 21, 'parent_id' => 19],
            ['name' => 'Thiếu nhi', 'image' => 'images/HFGDipl0SM.jpg', 'slug' => 'thieu-nhi', 'status' => 'inactive', 'order' => 22, 'parent_id' => 19],
            ['name' => 'Tâm lý - Kỹ năng sống', 'image' => 'images/E1RfzLJzwB.jpg', 'slug' => 'tam-ly-ky-nang-song', 'status' => 'inactive', 'order' => 23, 'parent_id' => 13],
            ['name' => 'Văn học', 'image' => 'images/wYyrqFGrO1.jpg', 'slug' => 'van-hoc', 'status' => 'inactive', 'order' => 24, 'parent_id' => 13],
            ['name' => 'Giáo khoa - Tham khảo', 'image' => 'images/bSgQ407gcU.jpg', 'slug' => 'giao-khoa-tham-khao', 'status' => 'inactive', 'order' => 25, 'parent_id' => 13],
            ['name' => 'Sách học ngoại ngữ', 'image' => 'images/of1FxaLNwB.jpg', 'slug' => 'sach-hoc-ngoai-ngu', 'status' => 'inactive', 'order' => 26, 'parent_id' => 13],
            ['name' => 'Nuôi Dạy Con', 'image' => 'images/4wcGiHsArI.jpg', 'slug' => 'nuoi-day-con', 'status' => 'active', 'order' => 28, 'parent_id' => 13],
            ['name' => 'Lịch Sử - Địa Lý - Tôn Giáo', 'image' => 'images/IIyAEany8W.jpg', 'slug' => 'lich-su-dia-ly-ton-giao', 'status' => 'inactive', 'order' => 29, 'parent_id' => 3],
            ['name' => 'Manga - Comic', 'image' => 'images/1ffEwJ8lAE.jpg', 'slug' => 'manga-comic', 'status' => 'inactive', 'order' => 30, 'parent_id' => 19],
            ['name' => 'Khoa học kỹ thuật', 'image' => 'images/yJsGDwzKQ8.jpg', 'slug' => 'khoa-hoc-ky-thuat', 'status' => 'inactive', 'order' => 31, 'parent_id' => 2],
            ['name' => 'Tiểu Sử Hồi Ký', 'image' => 'images/VB3pAgyQKZ.jpg', 'slug' => 'tieu-su-hoi-ky', 'status' => 'active', 'order' => 32, 'parent_id' => 1],
            ['name' => 'Chính Trị - Pháp Lý - Triết Học', 'image' => 'images/ByeQKssMzy.jpg', 'slug' => 'chinh-tri-phap-ly-triet-hoc', 'status' => 'inactive', 'order' => 36, 'parent_id' => 2],
        ];

        foreach ($categories as $category) {
            DB::table('categories_product')->insert([
                'name' => $category['name'],
                'image' => $category['image'],
                'slug' => $category['slug'],
                'status' => $category['status'],
                'order' => $category['order'],
                'parent_id' => $category['parent_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}