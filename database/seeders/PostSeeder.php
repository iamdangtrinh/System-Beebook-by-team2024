<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postTypes = ['review', 'blog'];
        $statuses = ['active', 'inactive'];
        $tags = ['Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React'];
        
        for ($i = 0; $i < 100; $i++) {
            $title = 'Bài viết số ' . ($i + 1);
            $slug = Str::slug($title);
            $content = 'Nội dung của bài viết số ' . ($i + 1);
            $postType = Arr::random($postTypes);
            $status = Arr::random($statuses);
            $image = 'post_image_' . ($i + 1) . '.jpg'; // Giả sử bạn có hình ảnh demo
            $metaTitle = 'Meta Title ' . ($i + 1);
            $metaDescription = 'Meta Description cho bài viết số ' . ($i + 1);
            $views = rand(0, 1000);
            $hot = rand(0, 1);
            $idUser = rand(1, 10); // Giả sử bạn có từ 1 đến 10 người dùng

            DB::table('posts')->insert([
                'post_type' => $postType,
                'title' => $title,
                'content' => $content,
                'views' => $views,
               'tags' => implode(',', Arr::random($tags, 2)), // Nối các tag thành chuỗi
                'image' => $image,
                'slug' => $slug,
                'status' => $status,
                'hot' => $hot,
                'meta_title_seo' => $metaTitle,
                'meta_description_seo' => $metaDescription,
                'id_user' => $idUser,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
