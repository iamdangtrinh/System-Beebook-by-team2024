<?php

namespace Database\Seeders;

use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Symfony\Component\DomCrawler\Crawler;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        try {
            $idCate = [
                12,
                9,
                11,
                6011,
                6718,
                17,
                6003,
                6038,
                6007,
            ];

            $seenNames = [];
            $seenImages = [];

            foreach ($idCate as $categoryId) {
                for ($currentPage = 1; $currentPage <= 2; $currentPage++) {
                    $response = Http::withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'
                    ])->retry(3, 1000)
                        ->get("https://www.fahasa.com/fahasa_catalog/product/loadproducts?category_id=$categoryId&currentPage=$currentPage&limit=400&order=num_orders");

                    if ($response->successful()) {
                        $data = $response->json();
                        $statuses = ['active', 'inactive'];

                        foreach ($data['product_list'] as $item) {
                            if (empty($item['product_name'])) {
                                continue;
                            }

                            $name = $item['product_name'];
                            $slug = Str::slug($name);
                            $status = Arr::random($statuses);
                            $image_src = $item['image_src'];

                            if (in_array($name, $seenNames) || in_array($image_src, $seenImages)) {
                                continue;
                            }

                            $seenNames[] = $name;
                            $seenImages[] = $image_src;

                            $imagePath = $this->isValidImage($image_src) ? $this->downloadImage($image_src) : null;
                            if ($imagePath === null || strlen($imagePath) > 100) {
                                $imagePath = null;
                            }

                            $existingSlug = DB::table('products')->where('slug', $slug)->exists();
                            if ($existingSlug) {
                                $slug = $slug . '-' . Str::random(5);
                            }

                            $quantity = isset($item['sold_qty']) ? $item['sold_qty'] : rand(0, 1000);
                            $price = isset($item['product_price']) ? str_replace('.', '', $item['product_price']) : rand(10000, 20000);
                            $sale_price = isset($item['product_finalprice']) ? str_replace('.', '', $item['product_finalprice']) : null;

                            // Gọi Node.js để lấy mô tả sản phẩm
                            $description = $this->getDescriptionContent($slug) ?? $name;

                            $product = [
                                'id_category' => rand(1, 55),
                                'name' => $name,
                                'description' => $description,
                                'slug' => $slug,
                                'status' => $status,
                                'quantity' => $quantity,
                                'url_video' => null,
                                'image_cover' => $imagePath,
                                'views' => rand(0, 5000),
                                'price' => $price,
                                'price_sale' => $sale_price,
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

                            // Thêm sản phẩm và lấy ID
                            $productId = DB::table('products')->insertGetId($product);

                            // Lấy và tải xuống hình ảnh bổ sung từ phần tử lightgallery-product-media
                            $extraImages = $this->fetchAndDownloadGalleryImages($slug);
                            if ($extraImages) {
                                DB::table('product_meta')->insert([
                                    'id_product' => $productId,
                                    'product_key' => 'thumbnail',
                                    'product_value' => implode(',', $extraImages),
                                ]);
                            }
                        }
                    } else {
                        $this->command->error('Lỗi khi lấy dữ liệu từ API. Category ID: ' . $categoryId . ' Page: ' . $currentPage);
                    }
                }
            }
        } catch (\Exception $e) {
            $this->command->error('Error: ' . $e->getMessage());
        }
    }

    private function getDescriptionContent($slug): ?string
    {
        try {
            $url = "https://www.fahasa.com/$slug.html";

            $client = new Client();
            $response = $client->request('GET', $url, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $html = $response->getBody()->getContents();
                $crawler = new Crawler($html);

                $description = $crawler->filter('#desc_content')->html();

                return trim($description);
            }
        } catch (\Exception $e) {
            $this->command->error("Error fetching description for slug $slug: " . $e->getMessage());
            return null;
        }
    }

    private function fetchAndDownloadGalleryImages($slug): array
    {
        $downloadedImages = [];
        try {
            $url = "https://www.fahasa.com/$slug.html";
            $client = new Client();
            $response = $client->request('GET', $url, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $html = $response->getBody()->getContents();
                $crawler = new Crawler($html);

                $imageUrls = $crawler->filter('#lightgallery-product-media img')->each(function (Crawler $node) {
                    return $node->attr('src');
                });

                foreach ($imageUrls as $url) {
                    $path = $this->downloadImage($url);
                    if ($path) {
                        $downloadedImages[] = $path;
                    }
                }
            }
        } catch (\Exception $e) {
            $this->command->error("Error fetching or downloading gallery images for slug $slug: " . $e->getMessage());
        }

        return $downloadedImages;
    }

    private function isValidImage($url)
    {
        $headers = get_headers($url, 1);
        if (isset($headers['Content-Length'])) {
            $size = (int) $headers['Content-Length'];
            return $size > 0 && $size <= 100 * 1024;
        }
        return false;
    }

    // private function downloadImage($url)
    // {
    //     $imageDirectory = public_path('userfiles/image/');
    //     $imageName = basename($url);
    //     $imageNameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME);
    //     $imagePath = $imageDirectory . $imageNameWithoutExtension . '.webp';

    //     if (!file_exists($imageDirectory)) {
    //         mkdir($imageDirectory, 0777, true);
    //     }

    //     try {
    //         $imageContent = file_get_contents($url);
    //         $image = imagecreatefromstring($imageContent);

    //         if ($image === false) {
    //             throw new \Exception('Cannot create image from data.');
    //         }

    //         imagewebp($image, $imagePath, 90);
    //         imagedestroy($image);

    //         return 'userfiles/image/' . $imageNameWithoutExtension . '.webp';
    //     } catch (\Exception $e) {
    //         $this->command->error('Error downloading or converting image: ' . $e->getMessage());
    //         return null;
    //     }
    // }

    private function downloadImage($url)
{
    $imageDirectory = public_path('userfiles/image/');
    $imageName = basename($url);
    $imageNameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME);
    $imagePath = $imageDirectory . $imageNameWithoutExtension . '.webp';

    if (!file_exists($imageDirectory)) {
        mkdir($imageDirectory, 0777, true);
    }

    try {
        $imageContent = file_get_contents($url);
        $image = imagecreatefromstring($imageContent);

        if ($image === false) {
            throw new \Exception('Cannot create image from data.');
        }

        // Kiểm tra nếu ảnh là dạng palette-based, chuyển đổi sang true color nếu cần
        if (!imageistruecolor($image)) {
            $trueColorImage = imagecreatetruecolor(imagesx($image), imagesy($image));
            imagecopy($trueColorImage, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
            imagedestroy($image);
            $image = $trueColorImage;
        }

        // Thử chuyển đổi sang WebP
        if (!imagewebp($image, $imagePath, 90)) {
            throw new \Exception('Failed to convert image to WebP.');
        }

        imagedestroy($image);

        return 'userfiles/image/' . $imageNameWithoutExtension . '.webp';
    } catch (\Exception $e) {
        $this->command->error('Error downloading or converting image: ' . $e->getMessage());
        return null; // Bỏ qua nếu không chuyển đổi được
    }
}


    private function generateRandomWeight(): int
    {
        return rand(1, 250) * 2;
    }

    private function randomLanguage(): string
    {
        return rand(0, 1) ? 'tiếng Việt' : 'tiếng Anh';
    }
}
