<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Services\CloudinaryUploader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Sube una imagen referencial por producto a Cloudinary y la registra en
 * product_images como imagen principal.
 *
 * Cada URL es una imagen especifica que matchea el producto. Cloudinary la
 * descarga + la deja en CDN + permite transformaciones. La URL original ya
 * no se usa en runtime una vez subida.
 *
 * Idempotente: si el producto ya tiene imagen principal, no la duplica.
 */
class ProductImageSeeder extends Seeder
{
    /**
     * slug del producto => URL de imagen referencial.
     */
    protected array $mapa = [
        'botella-termica-bambu-500ml'     => 'https://importacionesfacundo.com/wp-content/uploads/2026/05/simple-FB-1811.webp',
        'botella-deportiva-pet-reciclado' => 'https://images.unipromos.com/images/58/10622349.jpg',
        'bolsa-tote-algodon-organico'     => 'https://enviroflex.co/cdn/shop/files/NaturalOrganicCottonToteBags-Stow-N-GoToteBag-TB130.jpg?v=1720037752&width=493',
        'bolsa-malla-frutas-verduras'     => 'https://ecoreciclat.com/wp-content/uploads/2018/02/V2221.jpg',
        'set-cubiertos-bambu'             => 'https://tikafarma.com/cdn/shop/files/set-cubiertos-bambu-ecoduty-3.jpg?v=1729209391&width=1200',
        'sorbete-acero-cepillo'           => 'https://almma.pe/cdn/shop/files/DSF6205.jpg?v=1686221197&width=1200',
        'pack-oficina-eco'                => 'https://firstgreen.es/cdn/shop/files/Packonboardingoficina_Usodiarioazul.png?v=1769685592',
        'pack-picnic-familiar'            => 'https://plazavea.vteximg.com.br/arquivos/ids/34817066-435-435/imageUrl_1.jpg',
    ];

    public function run(CloudinaryUploader $uploader): void
    {
        foreach ($this->mapa as $slug => $urlStock) {
            $product = Product::where('slug', $slug)->first();
            if (! $product) {
                $this->command->warn("  Producto no encontrado: {$slug}");
                continue;
            }

            // Idempotencia: si ya hay imagen principal con public_id, skip.
            $existente = $product->images()->where('es_principal', true)->first();
            if ($existente && $existente->cloudinary_public_id) {
                $this->command->line("  <fg=gray>SKIP</> {$slug} (ya tiene imagen)");
                continue;
            }

            try {
                $tmp = $this->descargarTemporal($urlStock);
                $upload = $uploader->subirProductoDesdeArchivo($tmp, $slug);
                @unlink($tmp);

                $product->images()->create([
                    'ruta'                 => $upload['url'],
                    'cloudinary_public_id' => $upload['public_id'],
                    'alt_text'             => $product->nombre,
                    'orden'                => 0,
                    'es_principal'         => true,
                ]);

                $this->command->info("  <fg=green>OK</> {$slug}");
            } catch (\Throwable $e) {
                $this->command->error("  FAIL {$slug}: {$e->getMessage()}");
            }
        }
    }

    protected function descargarTemporal(string $url): string
    {
        $tmp = tempnam(sys_get_temp_dir(), 'eco_img_').'.bin';

        $ctx = stream_context_create([
            'http' => [
                'follow_location' => 1,
                'max_redirects'   => 5,
                'timeout'         => 30,
                'user_agent'      => 'Mozilla/5.0 (Ecocreations-Seeder)',
                'header'          => "Accept: image/*\r\n",
            ],
        ]);
        $contenido = @file_get_contents($url, false, $ctx);
        if ($contenido === false || strlen($contenido) < 1024) {
            throw new \RuntimeException("No se pudo descargar {$url}");
        }
        File::put($tmp, $contenido);
        return $tmp;
    }
}
