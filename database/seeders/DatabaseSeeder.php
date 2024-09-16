<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\TaxonomySeeder;
use Database\Seeders\CategoryProductSeeder;
use Database\Seeders\ProductsSeeder;
use Database\Seeders\CouponSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\WalletsSeeder;
use Database\Seeders\Comments;
use Database\Seeders\CartSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            TaxonomySeeder::class,
            CategoryProductSeeder::class,
            ProductsSeeder::class,
            CouponSeeder::class,
            UsersSeeder::class,
            PostSeeder::class,
            WalletsSeeder::class,
            Comments::class,
            CartSeeder::class,
        ]);
    }
}
