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
    private $seenNames = [];
    private $seenImages = [];
    private $statuses = ['active', 'inactive'];
    private $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36';

    public function run(): void
    {
        $idCate = [12, 9, 11, 6011, 6718, 17, 6003, 6038, 6007];

        foreach ($idCate as $categoryId) {
            for ($currentPage = 1; $currentPage <= 2; $currentPage++) {
                $this->processCategoryPage($categoryId, $currentPage);
            }
        }
    }

    private function processCategoryPage(int $categoryId, int $currentPage): void
    {
        try {
            $response = Http::withHeaders(['User-Agent' => $this->userAgent])
                ->retry(3, 1000)
                ->get("https://www.fahasa.com/fahasa_catalog/product/loadproducts?category_id=$categoryId&currentPage=$currentPage&limit=400&order=num_orders");

            if ($response->successful()) {
                $data = $response->json();
                foreach ($data['product_list'] as $item) {
                    $this->processProductItem($item);
                }
            } else {
                $this->command->error("Lỗi khi lấy dữ liệu từ API. Category ID: $categoryId Page: $currentPage");
            }
        } catch (\Exception $e) {
            $this->command->error('Error: ' . $e->getMessage());
        }
    }

    private function processProductItem(array $item): void
    {
        if (empty($item['product_name'])) {
            return;
        }

        $name = $item['product_name'];
        $slug = Str::slug($name);

        if ($this->isDuplicateProduct($name, $slug, $item['image_src'])) {
            return;
        }

        $status = Arr::random($this->statuses);
        $imagePath = $this->isValidImage($item['image_src']) ? $this->downloadImage($item['image_src']) : 'no_image.jpg';
        $imagePath = $this->validateImagePath($imagePath);

        $product = $this->createProductArray($item, $name, $slug, $status, $imagePath);
        $productId = DB::table('products')->insertGetId($product);

        $this->processExtraImages($slug, $productId);
    }

    private function isDuplicateProduct(string $name, string $slug, string $image_src): bool
    {
        if (DB::table('products')->where('slug', $slug)->exists() || in_array($name, $this->seenNames) || in_array($image_src, $this->seenImages)) {
            return true;
        }

        $this->seenNames[] = $name;
        $this->seenImages[] = $image_src;

        return false;
    }

    private function validateImagePath(?string $imagePath): ?string
    {
        return ($imagePath === null || strlen($imagePath) > 100) ? null : $imagePath;
    }

    private function createProductArray(array $item, string $name, string $slug, string $status, ?string $imagePath): array
    {
        return [
            'id_category' => rand(1, 32),
            'name' => $name,
            'description' => $this->getDescriptionContent($slug) ?? $name,
            'slug' => $slug,
            'status' => $status,
            'quantity' => $item['sold_qty'] ?? rand(0, 1000),
            'url_video' => null,
            'image_cover' => $imagePath,
            'views' => rand(0, 5000),
            'price' => isset($item['product_price']) ? str_replace('.', '', $item['product_price']) : rand(10000, 20000),
            'price_sale' => isset($item['product_finalprice']) ? str_replace('.', '', $item['product_finalprice']) : null,
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
    }

    private function processExtraImages(string $slug, int $productId): void
    {
        $extraImages = $this->fetchAndDownloadGalleryImages($slug);
        if ($extraImages) {
            foreach ($extraImages as $index => $image) {
                DB::table('product_meta')->insert([
                    'id_product' => $productId,
                    'product_key' => 'hinh' . ($index + 1),
                    'product_value' => $image,
                ]);
            }
        }
    }

    private function getDescriptionContent(string $slug): ?string
    {
        try {
            $url = "https://www.fahasa.com/$slug.html";
            $client = new Client();
            $response = $client->request('GET', $url, ['headers' => ['User-Agent' => $this->userAgent]]);

            if ($response->getStatusCode() === 200) {
                $html = $response->getBody()->getContents();
                $crawler = new Crawler($html);

                if ($crawler->filter('#desc_content')->count() > 0) {
                    return trim($crawler->filter('#desc_content')->html());
                }
            }
        } catch (\Exception $e) {
            $this->command->error("Error fetching description for slug $slug: " . $e->getMessage());
        }

        return null;
    }

    private function fetchAndDownloadGalleryImages(string $slug): array
    {
        $downloadedImages = [];
        try {
            $url = "https://www.fahasa.com/$slug.html";
            $client = new Client();
            $response = $client->request('GET', $url, ['headers' => ['User-Agent' => $this->userAgent]]);

            if ($response->getStatusCode() === 200) {
                $html = $response->getBody()->getContents();
                $crawler = new Crawler($html);

                $imageUrls = $crawler->filter('#lightgallery-product-media img')->each(function (Crawler $node) {
                    return $node->attr('src');
                });

                foreach ($imageUrls as $url) {
                    if ($this->isValidImageExtension($url)) {
                        $path = $this->downloadImage($url);
                        if ($path) {
                            $downloadedImages[] = $path;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            $this->command->error("Error fetching or downloading gallery images for slug $slug: " . $e->getMessage());
        }

        return $downloadedImages;
    }

    private function isValidImageExtension(string $url): bool
    {
        $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
        return in_array(strtolower($extension), ['png', 'webp', 'jpg']);
    }

    private function isValidImage(string $url): bool
    {
        $headers = get_headers($url, 1);
        return isset($headers['Content-Length']) && (int)$headers['Content-Length'] > 0 && (int)$headers['Content-Length'] <= 100 * 1024;
    }

    private function downloadImage(string $url): ?string
    {
        $imageDirectory = public_path('userfiles/image/');
        $imageName = basename($url);
        $imageNameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME);
        $imagePath = $imageDirectory . $imageNameWithoutExtension . '.webp';

        if (file_exists($imagePath)) {
            return '/userfiles/image/' . $imageNameWithoutExtension . '.webp';
        }

        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $imageContent = curl_exec($ch);
            curl_close($ch);

            if ($imageContent === false) {
                throw new \Exception('Unable to download image.');
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $imageContent);
            finfo_close($finfo);

            if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                throw new \Exception('Downloaded content is not a valid image format.');
            }

            $image = imagecreatefromstring($imageContent);
            if ($image === false || imageistruecolor($image) === false) {
                imagedestroy($image);
                return '/no_image.jpg';
            }

            imagewebp($image, $imagePath, 80);
            imagedestroy($image);

            return '/userfiles/image/' . $imageNameWithoutExtension . '.webp';
        } catch (\Exception $e) {
            $this->command->error('Error downloading or converting image: ' . $e->getMessage());
            return '/no_image.jpg';
        }
    }

    private function generateRandomWeight(): int
    {
        return rand(1, 250) * 2;
    }

    private function randomLanguage(): string
    {
        return rand(0, 1) ? 'tieng-viet' : 'tieng-anh';
    }
}