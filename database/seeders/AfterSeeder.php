<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\Comments;
use Database\Seeders\ProductsSeeder;
use Database\Seeders\CartSeeder;

class AfterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            // ProductsSeeder::class,
            // PostSeeder::class,
            CartSeeder::class,
            Comments::class,
            PostProductSeeder::class
        ]);
    }
}
