<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'nombre' => 'Botellas reutilizables',
                'slug' => 'botellas',
                'descripcion' => 'Botellas termicas y deportivas hechas de bambu, acero inoxidable y PET reciclado.',
                'icono' => 'wine',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Bolsas ecologicas',
                'slug' => 'bolsas',
                'descripcion' => 'Tote bags, bolsas malla y mochilas plegables de materiales reciclados.',
                'icono' => 'shopping-bag',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Utensilios sostenibles',
                'slug' => 'utensilios',
                'descripcion' => 'Cubiertos de bambu, sorbetes de acero y empaques compostables para llevar.',
                'icono' => 'utensils',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Packs eco',
                'slug' => 'packs',
                'descripcion' => 'Combos de regalo y kits familiares con multiples productos eco.',
                'icono' => 'package',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}