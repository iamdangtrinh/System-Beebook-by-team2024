<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        $generatedPhones = []; // Danh sách lưu trữ các số điện thoại đã tạo

        // Tạo email mặc định là admin@gmail.com với vai trò Admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Mật khẩu mặc định
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'phone' => '0123456789', // Số điện thoại mặc định
            'roles' => 'Admin',
            'status' => 'active',
            'avatar' => 'no_avt.png',
            'google_id' => null,
            'address' => $faker->address,
        ]);

        // Tạo 100 user ngẫu nhiên
        foreach (range(1, 100) as $index) {
            $phone = $this->generateUniquePhone($generatedPhones); // Tạo số điện thoại không trùng

            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->userName . '@gmail.com', // Email luôn có đuôi @gmail.com
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'phone' => $phone,
                'roles' => $faker->randomElement(['Admin', 'Customer']),
                'status' => $faker->randomElement(['active', 'inactive']),
                'avatar' => 'no_avt.png',
                'google_id' => $faker->optional()->randomNumber(),
                'address' => $faker->address,
            ]);
        }
    }

    /**
     * Generate a unique 10-digit phone number.
     */
    private function generateUniquePhone(array &$generatedPhones): string
    {
        $prefix = ['032', '033', '034', '035', '036', '037', '038', '039', '070', '079'];
        do {
            $randomPrefix = $prefix[array_rand($prefix)]; // Lấy ngẫu nhiên đầu số hợp lệ
            $number = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT); // Tạo 7 số ngẫu nhiên
            $phone = $randomPrefix . $number; // Kết hợp đầu số và 7 số ngẫu nhiên
        } while (in_array($phone, $generatedPhones)); // Kiểm tra trùng lặp

        $generatedPhones[] = $phone; // Thêm số vào danh sách đã tạo
        return $phone;
    }
}
