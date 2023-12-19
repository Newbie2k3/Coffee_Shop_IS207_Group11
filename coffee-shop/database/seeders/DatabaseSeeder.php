<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User accounts
        User::create(['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => '19012003', 'is_admin' => '1']);
        User::create(['name' => 'Guest', 'email' => 'guest@gmail.com', 'password' => '19012003', 'is_admin' => '0']);

        // Categories
        Category::create(['name' => 'Cà Phê', 'description' => 'Khám phá thế giới hương vị cà phê tinh tế với những loại hạt Arabica và Robusta chất lượng cao. Từ những hương thơm phức hợp đến độ đắng đặc trưng, loại cà phê này làm hài lòng cả những người yêu thưởng thức cà phê đích thực.']);
        Category::create(['name' => 'Trà', 'description' => 'Trải nghiệm sự tĩnh lặng và hương vị tinh tế của thế giới trà. Từ trà xanh tươi mát đến trà đen đậm đà, bộ sưu tập trà của chúng tôi là hành trình qua các vườn trà trên khắp thế giới, mang lại cảm giác bình yên và trải nghiệm thư giãn.']);
        Category::create(['name' => 'Bánh Ngọt', 'description' => 'Khám phá thiên đường của đồ ngọt với bộ sưu tập bánh ngọt phong phú của chúng tôi. Từ những chiếc bánh tinh tế đến những lớp kem mousse mềm mại, mỗi chiếc bánh đều là một tác phẩm nghệ thuật ẩm thực, đưa bạn đến một thế giới đầy màu sắc và ngon ngọt.']);
    }
}
