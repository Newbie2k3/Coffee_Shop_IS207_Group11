<?php

namespace Database\Seeders;

use App\Models\Paymentmethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paymentmethod::create(['name' => 'Thanh toán khi nhận hàng (COD)']);
        Paymentmethod::create(['name' => 'Thanh toán qua VNPAY']);
    }
}
