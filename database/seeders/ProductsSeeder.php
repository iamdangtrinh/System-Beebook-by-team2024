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
            ])->retry(3, 1000)
              ->get('https://www.fahasa.com/fahasa_catalog/product/loadproducts?category_id=6718&currentPage=2&limit=400&order=num_orders');

            // Kiểm tra xem yêu cầu có thành công không
            if ($response->successful()) {
                $data = $response->json();

                // Các trạng thái và giới hạn giá trị cần thiết
                $statuses = ['active', 'inactive'];

                foreach ($data['product_list'] as $item) {
                    // Kiểm tra nếu product_name trống thì bỏ qua
                    if (empty($item['product_name'])) {
                        continue; // Bỏ qua vòng lặp này
                    }

                    $name = $item['product_name'];
                    $slug = Str::slug($name);
                    $status = Arr::random($statuses);

                    $image_src = $item['image_src'];

                    // Kiểm tra kích thước hình ảnh trước khi tải về
                    $imagePath = null; // Mặc định là null
                    if ($this->isValidImage($image_src)) {
                        $imagePath = $this->downloadImage($image_src);
                    }

                    // Nếu $imagePath không hợp lệ hoặc lớn hơn 100 ký tự, bỏ qua
                    if ($imagePath === null || strlen($imagePath) > 100) {
                        $imagePath = null; // Đặt lại về null
                    }

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

    // Hàm kiểm tra kích thước hình ảnh
    private function isValidImage($url)
    {
        // Lấy header của URL để kiểm tra kích thước
        $headers = get_headers($url, 1);

        // Kiểm tra xem có thông tin kích thước hay không
        if (isset($headers['Content-Length'])) {
            $size = (int) $headers['Content-Length'];
            return $size > 0 && $size <= 100 * 1024; // Kích thước tối đa là 100 KB
        }

        return false; // Không hợp lệ nếu không có kích thước
    }

    // Hàm tải hình ảnh về và lưu vào thư mục
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
