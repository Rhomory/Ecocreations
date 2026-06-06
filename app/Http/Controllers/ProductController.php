<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        // Producto activo + categoría, imágenes (principal primero) y variantes activas con stock disponible
        $product = Product::with([
                'category',
                'images' => fn ($q) => $q->orderByDesc('es_principal')->orderBy('orden'),
                'variants' => fn ($q) => $q->where('activo', true)->orderBy('id'),
            ])
            ->where('slug', $slug)
            ->where('activo', true)
            ->firstOrFail();

        // Listas únicas para los selectores (solo si las variantes traen datos)
        $colores = $product->variants->pluck('color')->filter()->unique()->values();
        $tamanos = $product->variants->pluck('tamano')->filter()->unique()->values();

        // 4 productos relacionados de la misma categoría (excluye el actual)
        $relacionados = Product::with('category')
            ->where('activo', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('product.show', compact('product', 'colores', 'tamanos', 'relacionados'));
    }
}
