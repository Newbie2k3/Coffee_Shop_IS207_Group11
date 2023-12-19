<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(['name' => 'Product 1', 'description' => 'Description 1', 'price' => '10000', 'category_id' => '1', 'image' => 'https://t4.ftcdn.net/jpg/01/16/61/93/360_F_116619399_YA611bKNOW35ffK0OiyuaOcjAgXgKBui.jpg', 'quantity' => '100', 'status' => '1']);
        Product::create(['name' => 'Product 2', 'description' => 'Description 2', 'price' => '20000', 'category_id' => '2', 'image' => 'https://t4.ftcdn.net/jpg/01/16/61/93/360_F_116619399_YA611bKNOW35ffK0OiyuaOcjAgXgKBui.jpg', 'quantity' => '100', 'status' => '1']);
        Product::create(['name' => 'Product 3', 'description' => 'Description 3', 'price' => '30000', 'category_id' => '3', 'image' => 'https://t4.ftcdn.net/jpg/01/16/61/93/360_F_116619399_YA611bKNOW35ffK0OiyuaOcjAgXgKBui.jpg', 'quantity' => '100', 'status' => '1']);
    }
}
