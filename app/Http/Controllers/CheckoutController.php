<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function process(Request $request)
    {
        // Aquí irá la lógica de Niubiz cuando integremos pagos.
        return redirect()->route('checkout.confirmation', ['order' => 1]);
    }

    public function confirmation($order)
    {
        return view('checkout.confirmation', compact('order'));
    }
}
