<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $NameBook = [
        "Tây Sơn Nhất Đế",
        "Số Đỏ",
        "Dế Mèn Phiêu Lưu Ký",
        "Mảnh Đất Lắm Người Nhiều Ma",
        "Nhật ký trong tù",
        "Cánh Đồng Bất Tận",
        "Hạnh Phúc Của Một Cô Gái",
        "Lão Hạc",
        "Cơm Nhân Sâm",
        "Tôi Thấy Hoa Vàng Trên Cỏ Xanh",
        "Người Vợ Tốt",
        "Mắt Biếc",
        "Bố Già",
        "Đất Rừng Phương Nam",
        "Dưới Chân Đèo Ngang",
        "Truyện Kiều",
        "Đôi Dép",
        "Người Đàn Bà Bị Lãng Quên",
        "Nỗi Buồn Chiến Tranh",
        "Làng",
        "Rừng Na Uy",
        "Tiếng Chim Hót Trong Bụi Mận Gai",
        "Chí Phèo",
        "Kể chuyện danh nhân",
        "Cô Gái Đến Từ Hôm Qua",
        "Nữ Hoàng Của Đêm",
        "Gió Lên Vàng",
        "Sao Chổi",
        "Con Gái Của Rồng",
        "Nỗi Niềm Con Gái",
        "Tự Vọng",
        "Câu Chuyện Đầu Tiên",
        "Dòng Sông Hương",
        "Chết Trong Hân Hoan",
        "Đôi Cánh Tự Do",
        "Hương Xưa",
        "Những Ngày Rực Rỡ",
        "Cuộc Đời Còn Lại",
        "Cát Cát",
        "Những Đứa Con Của Rừng",
        "Nỗi Lòng Chị Em",
        "Mùa Hè Chói Lọi",
        "Người Đàn Ông Của Đêm",
        "Sáng Mắt",
        "Những Gương Mặt Tươi Cười",
        "Mặt Trời Đen",
        "Bước Chân Tìm Lại",
        "Những Ngày Xưa Cũ",
        "Lời Hứa",
        "Người Lạ Trong Thành Phố",
        "Mảnh Đời Kì Bí",
        "Chuyện Đời",
        "Mùa Xuân Từ Bi",
        "Ký Ức Quá Khứ",
        "Thế Giới Bí Ẩn",
        "Con Đường Tương Lai",
        "Hồn Ma Chưa Tìm Thấy",
        "Những Hình Ảnh Mới",
        "Những Đêm Tĩnh Lặng",
        "Mơ Mộng Đêm",
        "Những Điều Không Thể Nói",
        "Khát Vọng Sống",
        "Bức Tranh Cổ Tích",
        "Hành Trình Vượt Sóng",
        "Đêm Của Những Sao",
        "Hơi Thở Của Đất",
        "Chinh Phục Ước Mơ",
        "Tìm Về Ký Ức",
        "Chân Trời Mới",
        "Giấc Mơ Đêm",
        "Tìm Lại Yêu Thương",
        "Mùa Đông Lạnh Giá",
        "Ngày Mai Tươi Sáng",
        "Ghi Chép Lịch Sử",
        "Lời Cầu Nguyện",
        "Khúc Hát Tự Do",
        "Hành Trình Về Phương Đông",
        "Chuyện Ngày Xưa",
        "Từ Biệt Mùa Hè",
        "Những Hành Trình Đặc Biệt",
        "Đường Về Nhà",
        "Cuộc Phiêu Lưu Mới",
        "Chân Dung Một Thế Hệ",
        "Những Bí Ẩn Của Đêm",
        "Mùa Hè Đỏ Lửa",
        "Chuyện Về Một Ngày",
        "Mảnh Ghép Của Thời Gian",
        "Cánh Đồng Xanh",
        "Giấc Mơ Về Tự Do",
        "Hồi Ức Thời Niên Thiếu",
        "Những Trang Văn Đời",
        "Hơi Thở Từ Quá Khứ",
        "Đồng Quê Của Tôi"
    ];

    public function run(): void
    {
        $statuses = ['active', 'inactive'];
        $categoriesCount = DB::table('categories_product')->count(); // Đếm số danh mục có trong bảng
        $taxonomiesCount = DB::table('taxonomy')->count(); // Đếm số lượng tác giả, nhà xuất bản, nhà sản xuất có trong bảng taxonomy

        for ($i = 0; $i < count($this->NameBook); $i++) {
            $name = $this->NameBook[$i];
            $slug = Str::slug($name);
            $status = Arr::random($statuses);
            $parent_id = rand(1,21); // Giả sử các danh mục đã có từ 1 đến số lượng danh mục hiện có
            $author = $taxonomiesCount > 0 ? rand(1, $taxonomiesCount) : null;
            $publisher = $taxonomiesCount > 0 ? rand(1, $taxonomiesCount) : null;
            $manufacturer = $taxonomiesCount > 0 ? rand(1, $taxonomiesCount) : null;

            DB::table('products')->insert([
                'id_category' => $parent_id, // Chọn danh mục ngẫu nhiên
                'name' => $name,
                'description' => $name, // Tạo mô tả đơn giản
                'slug' => $slug,
                'status' => $status,
                'sold' => rand(0, 100), // Số lượng bán ra ngẫu nhiên
                'quantity' => rand(0, 1000), // Số lượng tồn kho ngẫu nhiên
                'url_video' => null,
                'views' => rand(0, 5000), // Số lượt xem ngẫu nhiên
                'price' => rand(10000, 1000000) / 100, // Giá ngẫu nhiên
                'price_sale' => rand(0, 1) ? rand(5000, 500000) / 100 : null, // Giá khuyến mãi ngẫu nhiên
                'hot' => rand(0, 1) ? true : false,
                'start_sale' => now()->addDays(rand(1, 30))->toDateString(),
                'end_sale' => now()->addDays(rand(31, 60))->toDateString(),
                'meta_seo' => $name,
                'description_seo' => $name,
                'author' => $author,
                'publisher' => $publisher,
                'manufacturer' => $manufacturer,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
