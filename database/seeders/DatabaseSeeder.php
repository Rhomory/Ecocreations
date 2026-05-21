<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        if (Producto::count() === 0) {
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
