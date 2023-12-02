<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(['name'=>'Admin','email'=>'admin@gmail.com','password'=>'19012003', 'is_admin'=>'1']);
        User::create(['name'=>'Guest','email'=>'guest@gmail.com','password'=>'19012003', 'is_admin'=>'0']);        
    }
}
