<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected const ENVIO_BASE = 9.90;

    public function index()
    {
        $cart = $this->cartActual();
        $items = $cart
            ? $cart->items()->with(['variant.product.category', 'variant.product.images'])->get()->map(fn ($i) => $this->mapearItem($i))->all()
            : [];

        $subtotal = collect($items)->sum(fn ($i) => $i['precio'] * $i['cantidad']);
        $envio    = $items ? self::ENVIO_BASE : 0;
        $total    = $subtotal + $envio;

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

        if (! $variant) {
            return $this->respuestaError($request, 'Este producto no tiene variantes disponibles.');
        }

        $precio = (float) $product->precio_base + (float) ($variant->precio_extra ?? 0);
        $personalizacion = trim((string) ($datos['personalizacion'] ?? '')) ?: null;

        $cart = $this->cartActualOCrear();

        // Buscar si ya existe un item con la misma variante + personalización (consolidar cantidades)
        $existente = $cart->items()
            ->where('product_variant_id', $variant->id)
            ->get()
            ->first(fn ($i) => ($i->customization['grabado'] ?? null) === $personalizacion);

        if ($existente) {
            $existente->update([
                'cantidad' => min(99, $existente->cantidad + $datos['cantidad']),
            ]);
        } else {
            $cart->items()->create([
                'product_variant_id' => $variant->id,
                'cantidad'           => $datos['cantidad'],
                'precio_unitario'    => $precio,
                'customization'      => $personalizacion ? ['grabado' => $personalizacion] : null,
            ]);
        }

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

        $cart = $this->cartActual();
        if ($cart) {
            $cartItem = $cart->items()->where('id', $item)->first();
            if ($cartItem) {
                $cartItem->update(['cantidad' => $datos['cantidad']]);
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'count' => $this->contarUnidades()]);
        }

        return back();
    }

    public function remove(Request $request, string $item)
    {
        $cart = $this->cartActual();
        if ($cart) {
            $cart->items()->where('id', $item)->delete();
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'count' => $this->contarUnidades()]);
        }

        return back();
    }

    // ---------- Helpers compartidos ----------

    /**
     * Devuelve el carrito actual (de la BD) sin crearlo si no existe.
     */
    public function cartActual(): ?Cart
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->first();
        }

        $sessionId = session()->getId();
        return Cart::where('session_id', $sessionId)->first();
    }

    /**
     * Devuelve el carrito actual, creándolo si hace falta.
     */
    public function cartActualOCrear(): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }

        $sessionId = session()->getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    /**
     * Cuenta total de unidades (sumando cantidades). Estático para usar desde el View::composer.
     */
    public static function contarUnidades(): int
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
        } else {
            $cart = Cart::where('session_id', session()->getId())->first();
        }

        return $cart ? (int) $cart->items()->sum('cantidad') : 0;
    }

    /**
     * Migra el carrito de sesión al carrito del usuario tras login.
     */
    public static function fusionarCarritoEnLogin(int $userId, string $sessionId): void
    {
        $cartSesion = Cart::where('session_id', $sessionId)->first();
        if (! $cartSesion) {
            return;
        }

        $cartUsuario = Cart::firstOrCreate(['user_id' => $userId]);

        foreach ($cartSesion->items as $item) {
            $existente = $cartUsuario->items()
                ->where('product_variant_id', $item->product_variant_id)
                ->get()
                ->first(fn ($i) => ($i->customization['grabado'] ?? null) === ($item->customization['grabado'] ?? null));

            if ($existente) {
                $existente->update([
                    'cantidad' => min(99, $existente->cantidad + $item->cantidad),
                ]);
            } else {
                $cartUsuario->items()->create([
                    'product_variant_id' => $item->product_variant_id,
                    'cantidad'           => $item->cantidad,
                    'precio_unitario'    => $item->precio_unitario,
                    'customization'      => $item->customization,
                ]);
            }
        }

        $cartSesion->items()->delete();
        $cartSesion->delete();
    }

    protected function mapearItem(CartItem $item): array
    {
        $variant = $item->variant;
        $product = $variant?->product;
        $imagen = $product?->images->sortByDesc('es_principal')->first()?->ruta;

        return [
            'clave'           => (string) $item->id,
            'nombre'          => $product?->nombre ?? 'Producto',
            'slug'            => $product?->slug ?? '#',
            'categoria'       => $product?->category->nombre ?? 'Sin categoría',
            'imagen'          => $imagen,
            'color'           => $variant?->color,
            'tamano'          => $variant?->tamano,
            'personalizacion' => $item->customization['grabado'] ?? null,
            'precio'          => (float) $item->precio_unitario,
            'cantidad'        => (int) $item->cantidad,
        ];
    }

    protected function resolverVariante(Product $product, ?string $color, ?string $tamano): ?ProductVariant
    {
        $query = $product->variants()->where('activo', true);

        if ($color) {
            $query->where('color', $color);
        }
        if ($tamano) {
            $query->where('tamano', $tamano);
        }

        return $query->first() ?? $product->variants->where('activo', true)->first() ?? $product->variants->first();
    }

    protected function respuestaError(Request $request, string $mensaje)
    {
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['ok' => false, 'mensaje' => $mensaje], 422);
        }

        return back()->withErrors(['cart' => $mensaje]);
    }
}
