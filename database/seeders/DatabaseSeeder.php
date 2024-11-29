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
use Database\Seeders\CouponSeeder;
use Database\Seeders\UsersSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            TaxonomySeeder::class,
            CategoryProductSeeder::class,
            CouponSeeder::class,
            UsersSeeder::class,
            // ProductsSeeder::class,
            // PostSeeder::class,
            // CartSeeder::class,
            // Comments::class,
        ]);
    }
}
