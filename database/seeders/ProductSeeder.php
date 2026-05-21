<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'category' => 'botellas',
                'nombre' => 'Botella termica de bambu 500ml',
                'slug' => 'botella-termica-bambu-500ml',
                'descripcion_corta' => 'Mantiene tu bebida fria 12h o caliente 6h. Tapa de bambu natural.',
                'descripcion_larga' => 'Botella de doble pared con interior de acero inoxidable 304 y exterior recubierto en bambu natural certificado FSC. Ideal para oficina, gimnasio o trekking. Personalizable con tu nombre o logo.',
                'precio_base' => 49.90,
                'es_personalizable' => true,
                'es_destacado' => true,
                'material' => 'Bambu + acero inoxidable',
                'variantes' => [
                    ['color' => 'Natural', 'tamano' => '500ml', 'sku' => 'BOT-BMB-NAT-500', 'stock' => 30],
                    ['color' => 'Negro mate', 'tamano' => '500ml', 'sku' => 'BOT-BMB-NEG-500', 'stock' => 25],
                ],
            ],
            [
                'category' => 'botellas',
                'nombre' => 'Botella deportiva PET reciclado',
                'slug' => 'botella-deportiva-pet-reciclado',
                'descripcion_corta' => 'Hecha 100% con PET reciclado del oceano. Tapa con valvula deportiva.',
                'descripcion_larga' => 'Botella ligera y resistente fabricada con plastico recuperado del oceano. Cada unidad evita 12 botellas plasticas en el mar. Apta para lavavajillas.',
                'precio_base' => 24.90,
                'es_personalizable' => true,
                'es_destacado' => false,
                'material' => 'PET reciclado',
                'variantes' => [
                    ['color' => 'Azul oceano', 'tamano' => '750ml', 'sku' => 'BOT-PET-AZL-750', 'stock' => 50],
                    ['color' => 'Verde menta', 'tamano' => '750ml', 'sku' => 'BOT-PET-VRD-750', 'stock' => 45],
                    ['color' => 'Coral', 'tamano' => '750ml', 'sku' => 'BOT-PET-COR-750', 'stock' => 40],
                ],
            ],
            [
                'category' => 'bolsas',
                'nombre' => 'Bolsa tote algodon organico',
                'slug' => 'bolsa-tote-algodon-organico',
                'descripcion_corta' => 'Tote bag de algodon organico GOTS. Capacidad 10kg.',
                'descripcion_larga' => 'Bolsa reutilizable certificada GOTS, con asas reforzadas y bolsillo interior. Perfecta para compras, libros o playa.',
                'precio_base' => 19.90,
                'es_personalizable' => true,
                'es_destacado' => true,
                'material' => 'Algodon organico',
                'variantes' => [
                    ['color' => 'Crudo', 'tamano' => 'Standard', 'sku' => 'BOL-TOT-CRU-STD', 'stock' => 60],
                    ['color' => 'Verde salvia', 'tamano' => 'Standard', 'sku' => 'BOL-TOT-VRD-STD', 'stock' => 55],
                ],
            ],
            [
                'category' => 'bolsas',
                'nombre' => 'Bolsa malla para frutas y verduras',
                'slug' => 'bolsa-malla-frutas-verduras',
                'descripcion_corta' => 'Set de 5 bolsas de malla. Reemplaza las bolsas plasticas del super.',
                'descripcion_larga' => 'Set de 5 bolsas de diferentes tamanos en malla de algodon reciclado. Cada bolsa tiene su tara impresa para que la balanza no la cobre.',
                'precio_base' => 14.50,
                'es_personalizable' => false,
                'es_destacado' => false,
                'material' => 'Algodon reciclado',
                'variantes' => [
                    ['color' => 'Natural', 'tamano' => 'Set 5pz', 'sku' => 'BOL-MLL-NAT-5PZ', 'stock' => 100],
                ],
            ],
            [
                'category' => 'utensilios',
                'nombre' => 'Set cubiertos de bambu (4 piezas)',
                'slug' => 'set-cubiertos-bambu',
                'descripcion_corta' => 'Tenedor, cuchara, cuchillo y palillos en estuche de tela.',
                'descripcion_larga' => 'Kit de cubiertos portatil para llevar a la oficina o de viaje. Bambu pulido y sellado con aceite vegetal. Estuche de algodon incluido.',
                'precio_base' => 29.90,
                'es_personalizable' => true,
                'es_destacado' => true,
                'material' => 'Bambu',
                'variantes' => [
                    ['color' => 'Natural', 'tamano' => '4pz', 'sku' => 'UTE-CUB-NAT-4PZ', 'stock' => 35],
                ],
            ],
            [
                'category' => 'utensilios',
                'nombre' => 'Sorbete de acero inoxidable + cepillo',
                'slug' => 'sorbete-acero-cepillo',
                'descripcion_corta' => 'Pack de 2 sorbetes reutilizables con cepillo de limpieza.',
                'descripcion_larga' => 'Sorbetes de acero inoxidable 18/8 grado alimenticio. Uno recto, uno curvo. Cepillo de cerdas naturales incluido.',
                'precio_base' => 12.90,
                'es_personalizable' => false,
                'es_destacado' => false,
                'material' => 'Acero inoxidable',
                'variantes' => [
                    ['color' => 'Plateado', 'tamano' => '2pz', 'sku' => 'UTE-SOR-PLT-2PZ', 'stock' => 80],
                    ['color' => 'Oro rosa', 'tamano' => '2pz', 'sku' => 'UTE-SOR-ORR-2PZ', 'stock' => 40],
                ],
            ],
            [
                'category' => 'packs',
                'nombre' => 'Pack oficina eco',
                'slug' => 'pack-oficina-eco',
                'descripcion_corta' => 'Botella + bolsa tote + libreta de papel reciclado.',
                'descripcion_larga' => 'Combo ideal para regalar a un colega o para empezar a reducir tu huella en la oficina. Incluye personalizacion gratuita.',
                'precio_base' => 79.90,
                'es_personalizable' => true,
                'es_destacado' => true,
                'material' => 'Mixto',
                'variantes' => [
                    ['color' => 'Verde', 'tamano' => 'Unico', 'sku' => 'PCK-OFC-VRD-UNI', 'stock' => 20],
                    ['color' => 'Crudo', 'tamano' => 'Unico', 'sku' => 'PCK-OFC-CRU-UNI', 'stock' => 18],
                ],
            ],
            [
                'category' => 'packs',
                'nombre' => 'Pack picnic familiar',
                'slug' => 'pack-picnic-familiar',
                'descripcion_corta' => '4 botellas + 4 sets de cubiertos + bolsa termica.',
                'descripcion_larga' => 'Todo lo que tu familia necesita para un picnic libre de plastico. Bolsa termica con interior reciclado y compartimentos.',
                'precio_base' => 119.90,
                'es_personalizable' => false,
                'es_destacado' => false,
                'material' => 'Mixto',
                'variantes' => [
                    ['color' => 'Verde', 'tamano' => '4 personas', 'sku' => 'PCK-PCN-VRD-4P', 'stock' => 15],
                ],
            ],
        ];

        foreach ($productos as $p) {
            $categoryId = DB::table('categories')->where('slug', $p['category'])->value('id');

            $productId = DB::table('products')->insertGetId([
                'category_id' => $categoryId,
                'nombre' => $p['nombre'],
                'slug' => $p['slug'],
                'descripcion_corta' => $p['descripcion_corta'],
                'descripcion_larga' => $p['descripcion_larga'],
                'precio_base' => $p['precio_base'],
                'es_personalizable' => $p['es_personalizable'],
                'es_destacado' => $p['es_destacado'],
                'material' => $p['material'],
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($p['variantes'] as $v) {
                DB::table('product_variants')->insert([
                    'product_id' => $productId,
                    'sku' => $v['sku'],
                    'color' => $v['color'],
                    'tamano' => $v['tamano'],
                    'precio_extra' => 0,
                    'stock' => $v['stock'],
                    'activo' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}