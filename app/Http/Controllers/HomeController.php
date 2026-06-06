<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $destacados = Product::with([
                'category',
                'images' => fn ($q) => $q->orderByDesc('es_principal')->orderBy('orden'),
            ])
            ->where('activo', true)
            ->where('es_destacado', true)
            ->take(4)
            ->get();

        // Hero carrusel: 3 productos destacados con copy distinto por slide.
        $slidesHero = $destacados->take(3)->values();

        return view('home', compact('destacados', 'slidesHero'));
    }
}
