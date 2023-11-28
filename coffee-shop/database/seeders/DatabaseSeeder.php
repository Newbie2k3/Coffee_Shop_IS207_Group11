<?php

namespace Database\Seeders;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create(['name'=>'Cà phê','slug'=>'Coffee','description'=>'Thức uống thơm ngon']);
        Category::create(['name'=>'Dụng cụ pha chế','slug'=>'Coffee-tools','description'=>'Dụng cụ hỗ trợ pha thức uống']);
    }
}
