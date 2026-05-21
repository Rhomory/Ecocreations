<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add(Request $request)
    {
        // Lógica para agregar al carrito (pendiente).
        return back();
    }

    public function update(Request $request, $item)
    {
        // Actualizar cantidad de un item (pendiente).
        return back();
    }

    public function remove($item)
    {
        // Quitar un item del carrito (pendiente).
        return back();
    }
}
