<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // Gửi yêu cầu HTTP tới API Fahasa với retry và headers
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'
            ])->retry(3, 1000) // Thử lại 3 lần, mỗi lần cách nhau 1000ms
            //   ->get('https://www.fahasa.com/tabslider/index/getdata/?limit=200');
              ->get('https://www.fahasa.com/fahasa_catalog/product/loadproducts?category_id=6718&currentPage=2&limit=400&order=num_orders');
            // Kiểm tra xem yêu cầu có thành công không
            if ($response->successful()) {
                $data = $response->json();

                // Các trạng thái và giới hạn giá trị cần thiết
                $statuses = ['active', 'inactive'];

                foreach ($data['product_list'] as $item) {
                    $name = $item['product_name'];
                    // $name = $item['name_a_label'];
                    $image_src = $item['image_src'];
                    $slug = Str::slug($name);
                    $status = Arr::random($statuses);

                    // Lấy URL hình ảnh từ item
                    $image_src = $item['image_src'];
                    // Tải hình ảnh về và lưu vào thư mục
                    $imagePath = $this->downloadImage($image_src);

                    // Đảm bảo các trường có giá trị hợp lệ
                    $product = [
                        'id_category' => rand(1, 21),
                        'name' => $name,
                        'description' => $name,
                        'slug' => $slug,
                        'status' => $status,
                        'quantity' => isset($item['sold_qty']) ? (int) $item['sold_qty'] : rand(0, 1000),
                        'url_video' => null,
                        'image_cover' => $imagePath,
                        'views' => rand(0, 5000),
                        'price' => isset($item['price']) ? (int) floor($item['price']) : rand(10000, 20000),
                        'price_sale' => isset($item['final_price']) ? (int) floor($item['final_price']) : null,
                        'hot' => (bool)rand(0, 1),
                        'meta_seo' => $name,
                        'description_seo' => $name,
                        'year' => rand(2018, 2024),
                        'weight' => $this->generateRandomWeight(),
                        'language' => $this->randomLanguage(),
                        'id_author' => rand(1, 21),
                        'id_translator' => rand(1, 21),
                        'id_manufacturer' => rand(1, 21),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    // Chèn dữ liệu vào bảng products
                    DB::table('products')->insert($product);
                }
            } else {
                $this->command->error('Lỗi.');
            }
        } catch (\Exception $e) {
            $this->command->error('Error: ' . $e->getMessage());
        }
    }

    private function downloadImage($url)
    {
        // Đường dẫn lưu hình ảnh
        $imageDirectory = public_path('userfiles/image/');
        $imageName = basename($url);
        $imagePath = $imageDirectory . $imageName;

        // Kiểm tra nếu thư mục không tồn tại, tạo thư mục
        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory, 0777, true);
        }

        // Lấy nội dung hình ảnh và lưu vào tệp
        try {
            $imageContent = file_get_contents($url);
            file_put_contents($imagePath, $imageContent);
            return 'userfiles/image/' . $imageName; // Trả về đường dẫn tương đối
        } catch (\Exception $e) {
            // Xử lý lỗi nếu không tải được hình ảnh
            $this->command->error('Error downloading image: ' . $e->getMessage());
            return null;
        }
    }

    // Hàm tạo cân nặng nhỏ hơn 500 và là số chẵn
    private function generateRandomWeight(): int
    {
        return rand(1, 250) * 2; // Nhân đôi để đảm bảo số chẵn và dưới 500
    }

    // Hàm random ngôn ngữ: có hoặc không có "tiếng Việt"
    private function randomLanguage(): string
    {
        return rand(0, 1) ? 'tiếng Việt' : 'tiếng Anh';
    }
}
