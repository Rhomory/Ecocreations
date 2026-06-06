<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = $user->orders()
            ->with(['items.variant.product.images'])
            ->latest()
            ->take(5)
            ->get();

        $totalOrders   = $user->orders()->count();
        $totalSpent    = $user->orders()->where('estado', '!=', 'cancelado')->sum('total');
        // ~0.45 kg de plástico evitado por pedido entregado (estimación marketing)
        $plasticAvoided = round($totalOrders * 0.45, 1);

        return view('account.index', compact('user', 'orders', 'totalOrders', 'totalSpent', 'plasticAvoided'));
    }

    public function orders(Request $request)
    {
        $user = auth()->user();

        $estadosValidos = ['pendiente', 'pagado', 'preparando', 'enviado', 'entregado', 'cancelado'];
        $request->validate([
            'estado' => ['nullable', Rule::in(['todos', ...$estadosValidos])],
        ]);
        $estado = $request->query('estado', 'todos');

        $query = $user->orders()->with(['items.variant.product.images']);

        if ($estado !== 'todos' && in_array($estado, $estadosValidos)) {
            $query->where('estado', $estado);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        // Conteos por estado para los chips de filtro
        $conteoPorEstado = $user->orders()
            ->selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->pluck('total', 'estado')
            ->toArray();
        $conteoPorEstado['todos'] = array_sum($conteoPorEstado);

        return view('account.orders', compact('user', 'orders', 'estado', 'conteoPorEstado'));
    }

    public function orderDetail($order)
    {
        $user = auth()->user();
        $order = $user->orders()
            ->with(['items.variant.product.images', 'address', 'paymentMethod', 'statusHistories'])
            ->findOrFail($order);

        return view('account.order-detail', compact('user', 'order'));
    }

    public function addresses()
    {
        $user = auth()->user();
        $addresses = $user->addresses;
        return view('account.addresses', compact('user', 'addresses'));
    }
}
