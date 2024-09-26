<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the number of cart records to create
        $numberOfCarts = 100;

        // Retrieve user and product IDs, names, and prices from the database
        $users = DB::table('users')->pluck('id')->toArray();
        $products = DB::table('products')->select('id', 'name', 'price', 'price_sale')->get();

        for ($i = 0; $i < $numberOfCarts; $i++) {
            $userId = Arr::random($users); // Randomly pick a user ID
            $product = $products->random(); // Randomly pick a product (id, name, price, price_sale)
            $quantity = rand(1, 10); // Random quantity between 1 and 10

            // Determine the price to use (if price_sale is available, use it; otherwise, use price)
            $price = $product->price_sale ? $product->price_sale : $product->price;

            // Insert the cart data into the carts table
            DB::table('carts')->insert([
                'id_user' => $userId,
                'id_product' => $product->id, // Store the product ID
                'price' => $price, // Ensure proper decimal format
                'quantity' => $quantity,
                'name' => $product->name, // Store the real product name
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
