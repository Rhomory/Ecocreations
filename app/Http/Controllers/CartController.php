<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected const SESSION_KEY = 'cart';

    public function index()
    {
        $items = $this->itemsDetallados();
        $subtotal = collect($items)->sum(fn ($i) => $i['precio'] * $i['cantidad']);
        $envio = $items ? 9.90 : 0;
        $total = $subtotal + $envio;

        return view('cart.index', compact('items', 'subtotal', 'envio', 'total'));
    }

    public function add(Request $request)
    {
        $datos = $request->validate([
            'product_id'      => ['required', 'integer', 'exists:products,id'],
            'cantidad'        => ['required', 'integer', 'min:1', 'max:99'],
            'color'           => ['nullable', 'string', 'max:50'],
            'tamano'          => ['nullable', 'string', 'max:50'],
            'personalizacion' => ['nullable', 'string', 'max:30'],
        ]);

        $product = Product::with('variants')->findOrFail($datos['product_id']);
        $variant = $this->resolverVariante($product, $datos['color'] ?? null, $datos['tamano'] ?? null);
        $precio = (float) $product->precio_base + (float) ($variant?->precio_extra ?? 0);

        $clave = $this->claveItem($product->id, $variant?->id, $datos['personalizacion'] ?? null);
        $cart = session(self::SESSION_KEY, []);

        if (isset($cart[$clave])) {
            $cart[$clave]['cantidad'] = min(99, $cart[$clave]['cantidad'] + $datos['cantidad']);
        } else {
            $cart[$clave] = [
                'product_id'      => $product->id,
                'variant_id'      => $variant?->id,
                'cantidad'        => $datos['cantidad'],
                'precio'          => $precio,
                'color'           => $datos['color'] ?? null,
                'tamano'          => $datos['tamano'] ?? null,
                'personalizacion' => $datos['personalizacion'] ?? null,
            ];
        }

        session([self::SESSION_KEY => $cart]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'ok'      => true,
                'mensaje' => 'Producto agregado al carrito',
                'count'   => $this->contarUnidades(),
            ]);
        }

        return redirect()->route('cart.index')->with('status', 'Producto agregado al carrito.');
    }

    public function update(Request $request, string $item)
    {
        $datos = $request->validate([
            'cantidad' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = session(self::SESSION_KEY, []);
        if (isset($cart[$item])) {
            $cart[$item]['cantidad'] = $datos['cantidad'];
            session([self::SESSION_KEY => $cart]);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'count' => $this->contarUnidades()]);
        }

        return back();
    }

    public function remove(Request $request, string $item)
    {
        $cart = session(self::SESSION_KEY, []);
        unset($cart[$item]);
        session([self::SESSION_KEY => $cart]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'count' => $this->contarUnidades()]);
        }

        return back();
    }

    protected function itemsDetallados(): array
    {
        $cart = session(self::SESSION_KEY, []);
        if (! $cart) {
            return [];
        }

        $productIds = collect($cart)->pluck('product_id')->unique();
        $productos = Product::with('category')->whereIn('id', $productIds)->get()->keyBy('id');

        $items = [];
        foreach ($cart as $clave => $linea) {
            $producto = $productos->get($linea['product_id']);
            if (! $producto) {
                continue;
            }
            $items[] = [
                'clave'           => $clave,
                'nombre'          => $producto->nombre,
                'slug'            => $producto->slug,
                'categoria'       => $producto->category->nombre ?? 'Sin categoría',
                'color'           => $linea['color'],
                'tamano'          => $linea['tamano'],
                'personalizacion' => $linea['personalizacion'],
                'precio'          => (float) $linea['precio'],
                'cantidad'        => (int) $linea['cantidad'],
            ];
        }

        return $items;
    }

    protected function resolverVariante(Product $product, ?string $color, ?string $tamano): ?ProductVariant
    {
        $query = $product->variants();

        if ($color) {
            $query->where('color', $color);
        }
        if ($tamano) {
            $query->where('tamano', $tamano);
        }

        return $query->first() ?? $product->variants->first();
    }

    protected function claveItem(int $productId, ?int $variantId, ?string $personalizacion): string
    {
        return md5("{$productId}|{$variantId}|" . ($personalizacion ?? ''));
    }

    protected function contarUnidades(): int
    {
        return collect(session(self::SESSION_KEY, []))->sum('cantidad');
    }
}
