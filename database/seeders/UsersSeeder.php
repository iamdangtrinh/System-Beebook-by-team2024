<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'phone' => substr($faker->phoneNumber, 0, 10),
                'roles' => $faker->randomElement(['admin', 'customer']),
                'status' => $faker->randomElement(['active', 'inactive']),
                'avatar' => 'path/to/image' . $index . '.jpg',
                'facebook_id' => $faker->optional()->randomNumber(),
                'google_id' => $faker->optional()->randomNumber(),
                'address' => $faker->address,
                'birthday' => $faker->date('Y-m-d', '2000-01-01'),
            ]);
    }
}
}
