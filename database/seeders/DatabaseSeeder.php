<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
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

        // Imagenes de Cloudinary: solo si no hay ninguna registrada todavia.
        if (ProductImage::count() === 0) {
            $this->call(ProductImageSeeder::class);
        }
    }
}
