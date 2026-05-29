<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // --- Consulta base: solo productos activos, con su categoría cargada ---
        $query = Product::with('category')->where('activo', true);

        // --- Filtro: búsqueda por nombre (?q=...) ---
        if ($request->filled('q')) {
            $query->where('nombre', 'like', '%' . $request->query('q') . '%');
        }

        // --- Filtro: categoría (?categoria=botellas) ---
        if ($request->filled('categoria')) {
            $query->whereHas('category', function ($c) use ($request) {
                $c->where('slug', $request->query('categoria'));
            });
        }

        // --- Filtro: precio máximo (?precio_max=...) ---
        if ($request->filled('precio_max')) {
            $query->where('precio_base', '<=', $request->query('precio_max'));
        }

        // --- Filtro: material (?material=...) ---
        if ($request->filled('material')) {
            $query->where('material', 'like', '%' . $request->query('material') . '%');
        }

        // --- Orden (?orden=...) ---
        switch ($request->query('orden')) {
            case 'precio_asc':
                $query->orderBy('precio_base', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio_base', 'desc');
                break;
            default: // 'recientes'
                $query->latest();
                break;
        }

        // --- Paginación: 9 por página (grid 3x3), conserva los filtros en la URL ---
        $products = $query->paginate(9)->withQueryString();

        // --- Sidebar: categorías activas con el conteo de productos ---
        $categories = Category::where('activo', true)
            ->withCount(['products' => fn ($p) => $p->where('activo', true)])
            ->get();

        // --- Banner "Producto del mes": primer producto destacado ---
        $featured = Product::with('category')
            ->where('activo', true)
            ->where('es_destacado', true)
            ->first();

        return view('catalog.index', compact('products', 'categories', 'featured'));
    }

    public function show(Request $request, $slug)
    {
        // Buscar la categoría por slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Consulta base de productos de esa categoría
        $query = $category->products()->where('activo', true);

        // --- Orden (?orden=...) ---
        switch ($request->query('orden')) {
            case 'precio_asc':
                $query->orderBy('precio_base', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio_base', 'desc');
                break;
            default: // 'recientes'
                $query->latest();
                break;
        }

        // Paginación limpia sin sidebar
        $products = $query->paginate(12)->withQueryString();

        return view('catalog.show', compact('category', 'products'));
    }
}
