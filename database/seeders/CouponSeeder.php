<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('coupons')->insert([
            [
                'codigo' => 'BIENVENIDA10',
                'tipo' => 'porcentaje',
                'valor' => 10.00,
                'min_compra' => 50.00,
                'valido_desde' => Carbon::now(),
                'valido_hasta' => Carbon::now()->addMonths(3),
                'usos_max' => 500,
                'usos_actuales' => 0,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'ECO20',
                'tipo' => 'porcentaje',
                'valor' => 20.00,
                'min_compra' => 100.00,
                'valido_desde' => Carbon::now(),
                'valido_hasta' => Carbon::now()->addMonths(2),
                'usos_max' => 100,
                'usos_actuales' => 0,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'DELIVERY',
                'tipo' => 'monto_fijo',
                'valor' => 15.00,
                'min_compra' => 80.00,
                'valido_desde' => Carbon::now(),
                'valido_hasta' => Carbon::now()->addMonth(),
                'usos_max' => null,
                'usos_actuales' => 0,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}