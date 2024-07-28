<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Danh sách họ phổ biến
        $common_surnames = [
            'Nguyễn', 'Lê', 'Trần', 'Phạm', 'Vũ', 'Hoàng', 'Đỗ', 'Hà', 'Bùi', 'Tôn',
            'Dương', 'Ngô', 'Lý', 'Đặng', 'Nhữ', 'Nguyen', 'Mai', 'Lâm', 'Cao', 'Võ',
            'Phan', 'Hồ', 'Bành', 'Tạ', 'Lưu', 'Ngọc', 'Quách', 'Ngân', 'Đinh', 'Tôn',
            'Hoàng', 'Bùi', 'Khuất', 'Đoàn', 'Thân', 'Hà', 'Tống', 'Tân', 'Cung', 'Trí'
        ];

        // Danh sách các tên phổ biến
        $names = [
            'Anh', 'Bảo', 'Cường', 'Dũng', 'Hải', 'Hòa', 'Hoàng', 'Hương', 'Hùng', 'Khánh',
            'Lan', 'Linh', 'Mai', 'Minh', 'Nam', 'Nhung', 'Phương', 'Quân', 'Sơn', 'Tú',
            'Thanh', 'Trí', 'Trung', 'Tuyết', 'Vân', 'Vũ', 'Yến'
        ];

        for ($i = 0; $i < 10; $i++) {
            $surname = Arr::random($common_surnames);
            $name = Arr::random($names);
            $fullname = $surname . ' ' . $name;
            $fullnameNoDiacritics = transliterator_transliterate('Any-Latin; Latin-ASCII', $fullname);
            $emailUsername = strtolower(str_replace(' ', '', $fullnameNoDiacritics));
            
            DB::table('users')->insert([
                'name' => $fullname,
                'email' => $emailUsername . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
