<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            PaymentMethodSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            CouponSeeder::class,
        ]);
    }
}