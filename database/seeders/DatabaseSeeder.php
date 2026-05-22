<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        if (Product::count() === 0) {
            $this->call([
                CategorySeeder::class,
                PaymentMethodSeeder::class,
                UserSeeder::class,
                ProductSeeder::class,
                CouponSeeder::class,
            ]);
        }
    }
}
