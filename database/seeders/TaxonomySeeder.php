<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mảng chứa 50 tác giả
        $authors = [
            "Nguyễn Du",
            "Nam Cao",
            "Tô Hoài",
            "Nguyễn Nhật Ánh",
            "Nguyễn Khải",
            "Bảo Ninh",
            "Hồ Chí Minh",
            "Lỗ Tấn",
            "Vũ Trọng Phụng",
            "Nguyễn Ngọc Tư",
            "Xuân Diệu",
            "Huy Cận",
            "Chế Lan Viên",
            "Nguyễn Huy Thiệp",
            "Nguyễn Công Hoan",
            "Mai Akhilesh",
            "Nguyễn Trí Huân",
            "Phạm Thị Hoài",
            "Vũ Bằng",
            "Tố Hữu",
            "Bùi Giáng",
            "Trí Đăng",
            "Lê Minh Khuê",
            "Đặng Thùy Trâm",
            "Trương Hệ Thống",
            "Nguyễn Quang Sáng",
            "Nguyễn Duy",
            "Trần Vỹ",
            "Nguyễn Thị Phương",
            "Lê Văn Thảo",
            "Nguyễn Tường Bách",
            "Nhật Chiêu",
            "Thụy An",
            "Tạ Duy Anh",
            "Nguyễn Hồng Phong",
            "Bùi Xuân Phái",
            "Nguyễn Mạnh Tuấn",
            "Hoàng Cầm",
            "Hương Cảng",
            "Trí Sinh",
            "Lý Lan",
            "Nguyễn Ái Quốc",
            "Phan Thị Vàng Anh",
            "Như Bình",
            "Thúy Vân",
            "Vân Đài",
            "Nguyễn Thị Vân",
            "Bích Hà",
            "Nguyễn Hữu Liêm"
        ];

        // Mảng chứa 50 người dịch
        $translators = [
            "Nguyễn Hồng Dương",
            "Lê Hồng Sâm",
            "Phan Hồng",
            "Trần Thị Thanh",
            "Lê Minh Phong",
            "Hồ Thị Thúy",
            "Đặng Thị Hòa",
            "Nguyễn Văn Bằng",
            "Bùi Thị Liên",
            "Nguyễn Hoàng Nam",
            "Trịnh Hoài",
            "Lê Thị Tường",
            "Phạm Văn Hưng",
            "Nguyễn Thị Mai",
            "Nguyễn Đình Phúc",
            "Trần Minh Đức",
            "Hoàng Anh Tuấn",
            "Vũ Thị Yến",
            "Đoàn Minh Vương",
            "Lê Quang Minh",
            "Bùi Thị Hòa",
            "Nguyễn Thị Hạnh",
            "Nguyễn Ngọc Ánh",
            "Phan Thị Bích",
            "Lương Thị Bảo",
            "Nguyễn Hoài Nam",
            "Trí An",
            "Hà Thị Thanh",
            "Nguyễn Hữu Long",
            "Nguyễn Ngọc Linh",
            "Trương Hồng Thái",
            "Lê Hoàng Hưng",
            "Nguyễn Thị Mai Lan",
            "Phan Văn Sơn",
            "Lê Thanh Hải",
            "Đặng Minh Chi",
            "Nguyễn Minh Thùy",
            "Hà Minh Vũ",
            "Nguyễn Thị Diễm",
            "Trần Thị Hồng",
            "Nguyễn Xuân Tình",
            "Lê Văn Thắng",
            "Đinh Thị Bình",
            "Trịnh Thị Vân",
            "Nguyễn Quốc Việt",
            "Bùi Thị Minh"
        ];

        // Mảng chứa 50 nhà xuất bản
        $publishers = [
            "Nhà Xuất Bản Kim Đồng",
            "Nhà Xuất Bản Văn Hóa Thông Tin",
            "Nhà Xuất Bản Trẻ",
            "Nhà Xuất Bản Lao Động",
            "Nhà Xuất Bản Hội Nhà Văn",
            "Nhà Xuất Bản Đà Nẵng",
            "Nhà Xuất Bản TP.HCM",
            "Nhà Xuất Bản Phụ Nữ",
            "Nhà Xuất Bản Thế Giới",
            "Nhà Xuất Bản Đại Học Quốc Gia",
            "Nhà Xuất Bản Phương Đông",
            "Nhà Xuất Bản Đại Nam",
            "Nhà Xuất Bản Thanh Niên",
            "Nhà Xuất Bản Sự Thật",
            "Nhà Xuất Bản Chính Trị Quốc Gia",
            "Nhà Xuất Bản Khoa Học Xã Hội",
            "Nhà Xuất Bản Giao Thông Vận Tải",
            "Nhà Xuất Bản Kinh Tế Quốc Dân",
            "Nhà Xuất Bản Tài Chính",
            "Nhà Xuất Bản Bách Khoa",
            "Nhà Xuất Bản Hồng Đức",
            "Nhà Xuất Bản Mỹ Thuật",
            "Nhà Xuất Bản Học Viện",
            "Nhà Xuất Bản Văn Hóa Nghệ Thuật",
            "Nhà Xuất Bản Đông A",
            "Nhà Xuất Bản Tiến Bộ",
            "Nhà Xuất Bản Nhân Dân",
            "Nhà Xuất Bản Giải Phóng",
            "Nhà Xuất Bản Quân Đội Nhân Dân",
            "Nhà Xuất Bản Thời Đại",
            "Nhà Xuất Bản Nông Nghiệp",
            "Nhà Xuất Bản Giáo Dục",
            "Nhà Xuất Bản Hữu Nguyên",
            "Nhà Xuất Bản Đuốc Phương Đông",
            "Nhà Xuất Bản Hòa Bình",
            "Nhà Xuất Bản Tự Do",
            "Nhà Xuất Bản Trí Thức",
            "Nhà Xuất Bản Đại Dương",
            "Nhà Xuất Bản Tinh Hoa",
            "Nhà Xuất Bản Ánh Sáng",
            "Nhà Xuất Bản Vạn Hạnh",
            "Nhà Xuất Bản Đất Việt",
            "Nhà Xuất Bản Việt Nam",
            "Nhà Xuất Bản Văn Mới",
            "Nhà Xuất Bản Nam Việt",
            "Nhà Xuất Bản Địa Chất",
            "Nhà Xuất Bản Phúc Minh",
            "Nhà Xuất Bản Cẩm Phong",
            "Nhà Xuất Bản Xuân Thứ",
            "Nhà Xuất Bản Thời Trang"
        ];

        // Kết hợp tất cả các loại vào một mảng để dễ dàng lựa chọn
        $taxonomyTypes = ['author', 'translator', 'manufacture'];
        // Chèn dữ liệu vào bảng 'taxonomy'
        foreach ($taxonomyTypes as $type) {
            $items = [];
            switch ($type) {
                case 'author':
                    $items = $authors;
                    break;
                case 'translator':
                    $items = $translators;
                    break;
                case 'manufacture':
                    $items = $publishers;
                    break;
            }

            foreach ($items as $name) {
                DB::table('taxonomy')->insert([
                    'type' => $type,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
