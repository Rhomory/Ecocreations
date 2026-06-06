<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;

/**
 * Wrapper delgado sobre el SDK oficial de Cloudinary para centralizar
 * carpetas, naming, y transformaciones por defecto.
 *
 * Uso tipico desde un controller admin:
 *
 *     $upload = app(CloudinaryUploader::class)->subirProducto($request->file('imagen'));
 *     ProductImage::create([
 *         'product_id'           => $product->id,
 *         'ruta'                 => $upload['url'],
 *         'cloudinary_public_id' => $upload['public_id'],
 *     ]);
 */
class CloudinaryUploader
{
    protected const CARPETA_BASE = 'ecocreations';

    public function subirProducto(UploadedFile $archivo, ?string $slug = null): array
    {
        return $this->subir($archivo->getRealPath(), self::CARPETA_BASE.'/productos', $slug);
    }

    public function subirVariante(UploadedFile $archivo, ?string $sku = null): array
    {
        return $this->subir($archivo->getRealPath(), self::CARPETA_BASE.'/variantes', $sku);
    }

    public function subirCategoria(UploadedFile $archivo, ?string $slug = null): array
    {
        return $this->subir($archivo->getRealPath(), self::CARPETA_BASE.'/categorias', $slug);
    }

    /**
     * Variantes que aceptan un path absoluto. Utiles desde seeders / comandos.
     */
    public function subirProductoDesdeArchivo(string $path, ?string $slug = null): array
    {
        return $this->subir($path, self::CARPETA_BASE.'/productos', $slug);
    }

    public function subirVarianteDesdeArchivo(string $path, ?string $sku = null): array
    {
        return $this->subir($path, self::CARPETA_BASE.'/variantes', $sku);
    }

    public function subirCategoriaDesdeArchivo(string $path, ?string $slug = null): array
    {
        return $this->subir($path, self::CARPETA_BASE.'/categorias', $slug);
    }

    /**
     * Sube un archivo a Cloudinary y devuelve la URL segura + public_id.
     *
     * @return array{url:string,public_id:string,width:int,height:int}
     */
    protected function subir(string $path, string $carpeta, ?string $nombre = null): array
    {
        $opciones = [
            'folder'        => $carpeta,
            'resource_type' => 'image',
            // Si subimos la misma imagen 2 veces (mismo slug) Cloudinary la sobreescribe
            // en vez de crear una copia.
            'overwrite' => true,
        ];
        if ($nombre) {
            $opciones['public_id'] = $nombre;
        }

        // La API publica del paquete es uploadApi()->upload(), no Cloudinary::upload().
        // Devuelve un ApiResponse (array-accessible) con secure_url, public_id, etc.
        $resultado = Cloudinary::uploadApi()->upload($path, $opciones);

        return [
            'url'       => (string) $resultado['secure_url'],
            'public_id' => (string) $resultado['public_id'],
            'width'     => (int) ($resultado['width'] ?? 0),
            'height'    => (int) ($resultado['height'] ?? 0),
        ];
    }

    /**
     * Borra un asset por su public_id. No falla si no existe.
     */
    public function borrar(?string $publicId): void
    {
        if (! $publicId) {
            return;
        }
        try {
            Cloudinary::uploadApi()->destroy($publicId);
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
