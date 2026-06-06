<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // KPIs
        $totalSales = Order::where('estado', '!=', 'cancelado')->sum('total');
        $ordersCount = Order::count();
        $clientsCount = User::where('role', 'cliente')->count();
        $productsCount = Product::count();

        // Recent Orders (last 5)
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Low stock products (under 5 units)
        $lowStockProducts = ProductVariant::with('product')
            ->where('stock', '<', 5)
            ->where('activo', true)
            ->take(5)
            ->get();

        // Sales graph for last 7 days
        $salesData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            // Day name (capitalized, first letter)
            $dayName = ucfirst(Carbon::now()->subDays($i)->translatedFormat('D'));
            $sum = Order::whereDate('created_at', $date)
                ->where('estado', '!=', 'cancelado')
                ->sum('total');
            
            $salesData[] = [
                'day' => $dayName,
                'date' => $date,
                'amount' => (float)$sum
            ];
        }

        return view('admin.dashboard', compact(
            'totalSales',
            'ordersCount',
            'clientsCount',
            'productsCount',
            'recentOrders',
            'lowStockProducts',
            'salesData'
        ));
    }
}

