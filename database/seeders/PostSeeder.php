<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Symfony\Component\DomCrawler\Crawler;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $postTypes = ['review', 'blog'];
        $statuses = ['active', 'inactive'];
        $tags = ['Sách khoa học', 'Tâm lý', 'Viễn tưởng', 'Phát triển bản thân'];

        // Loop through pages from 1 to 15
        for ($page = 1; $page <= 15; $page++) {
            $this->fetchArticles($page, $postTypes, $statuses, $tags);
        }
    }

    private function fetchArticles($page, $postTypes, $statuses, $tags)
    {
        $url = "https://www.alphabooks.vn/tin-tuc?page=$page";
        $response = Http::get($url);

        if ($response->successful()) {
            $crawler = new Crawler($response->body());
            $articles = $crawler->filter('.item_blog_base');

            foreach ($articles as $article) {
                $articleCrawler = new Crawler($article);
                $title = $articleCrawler->filter('.a-title')->attr('title');
                $slug = $articleCrawler->filter('.a-title')->attr('href');
                $image = $articleCrawler->filter('.thumb img')->attr('data-src'); // Corrected here
                $description = $articleCrawler->filter('.content_blog p')->text();
                $pathUrl = $this->downloadImage($image);
                // Fetch article details
                $content = $this->fetchArticleDetails($slug);

                // Ensure title and content are not empty
                if (!empty($title) && !empty($content)) {
                    $metaTitleSeo = "Meta Title for $title"; // Generate meta title
                    // Check the length of meta_title_seo
                    if (strlen($metaTitleSeo) >= 100) {
                        echo "Bỏ qua bài viết: $title vì meta_title_seo quá dài.\n";
                        continue; // Skip this article
                    }

                    // Insert each article directly into the database
                    DB::table('posts')->insert([
                        'post_type' => Arr::random($postTypes),
                        'title' => $title,
                        'content' => $content,
                        'views' => rand(0, 1000),
                        'tags' => implode(',', Arr::random($tags, 2)), // Concatenate tags
                        'image' => $pathUrl,
                        'slug' => Str::slug($title),
                        'status' => Arr::random($statuses),
                        'hot' => rand(0, 1),
                        'meta_title_seo' => $metaTitleSeo,
                        'meta_description_seo' => "Meta Description for $title",
                        'id_user' => rand(1, 10), // Assume you have between 1 and 10 users
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    echo "Đã chèn bài viết: $title\n"; // Log each inserted article
                }
            }
        } else {
            echo "Lỗi khi lấy dữ liệu từ trang: $url\n";
        }
    }

    private function downloadImage($url)
    {
        // Đường dẫn lưu hình ảnh
        $imageDirectory = public_path('userfiles/posts/');
        $imageName = basename($url);
        $imageNameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME);
        $imagePath = $imageDirectory . $imageNameWithoutExtension . '.webp'; // Lưu với đuôi .webp

        // Kiểm tra nếu thư mục không tồn tại, tạo thư mục
        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory, 0777, true);
        }

        // Lấy nội dung hình ảnh và chuyển đổi định dạng
        try {
            $imageContent = file_get_contents($url);
            $image = imagecreatefromstring($imageContent);

            if ($image === false) {
                throw new \Exception('Không thể tạo hình ảnh từ dữ liệu.');
            }

            // Lưu hình ảnh dưới dạng WebP
            imagewebp($image, $imagePath, 90); // 80 là chất lượng hình ảnh, bạn có thể điều chỉnh
            imagedestroy($image); // Giải phóng bộ nhớ

            return 'userfiles/posts/' . $imageNameWithoutExtension . '.webp'; // Trả về đường dẫn tương đối
        } catch (\Exception $e) {
            // Xử lý lỗi nếu không tải được hình ảnh
            $this->command->error('Error downloading or converting image: ' . $e->getMessage());
            return null;
        }
    }


    private function fetchArticleDetails($slug)
    {
        $url = "https://www.alphabooks.vn$slug";
        $response = Http::get($url);

        if ($response->successful()) {
            $crawler = new Crawler($response->body());
            return $crawler->filter('.article-content')->html();
        }

        return ''; // Return empty if not successful
    }
}
