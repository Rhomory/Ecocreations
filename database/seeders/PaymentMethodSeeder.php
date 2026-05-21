<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'nombre' => 'Tarjeta (Niubiz)',
                'codigo' => 'niubiz',
                'icono' => 'credit-card',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Yape',
                'codigo' => 'yape',
                'icono' => 'smartphone',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Plin',
                'codigo' => 'plin',
                'icono' => 'smartphone',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Contraentrega',
                'codigo' => 'cod',
                'icono' => 'truck',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}