<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    protected const ENVIO_ESTANDAR = 9.90;
    protected const ENVIO_EXPRESS  = 19.90;
    protected const ENVIO_RECOJO   = 0.00;
    protected const IGV_TASA       = 0.18;

    public function index(Request $request)
    {
        $cartCtrl = new CartController();
        $cart = $cartCtrl->cartActual();

        if (! $cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')
                ->with('status', 'Agregá productos a tu carrito antes de continuar.');
        }

        $items = $cart->items()->with(['variant.product.images'])->get()->map(function ($item) {
            $variant = $item->variant;
            $product = $variant?->product;
            return (object) [
                'id'              => $item->id,
                'nombre'          => $product?->nombre ?? 'Producto',
                'variante'        => collect([$variant?->color, $variant?->tamano])->filter()->implode(' · '),
                'grabado'         => $item->customization['grabado'] ?? null,
                'imagen'          => $product?->images->sortByDesc('es_principal')->first()?->ruta,
                'precio'          => (float) $item->precio_unitario,
                'cantidad'        => (int) $item->cantidad,
                'total_linea'     => (float) $item->precio_unitario * (int) $item->cantidad,
            ];
        });

        $subtotal = $items->sum('total_linea');
        $envio    = self::ENVIO_ESTANDAR;
        $total    = $subtotal + $envio;

        // Direccion principal del usuario (si es cliente)
        $direccionPrincipal = Auth::check()
            ? Auth::user()->addresses()->where('es_principal', true)->first()
            : null;

        return view('checkout.index', compact('items', 'subtotal', 'envio', 'total', 'direccionPrincipal'));
    }

    public function process(Request $request)
    {
        $datos = $request->validate([
            // Contacto
            'nombre'        => ['required', 'string', 'max:120'],
            'telefono'      => ['required', 'string', 'max:20'],
            'email'         => ['required', 'email', 'max:120'],
            // Direccion
            'calle'         => ['required', 'string', 'max:200'],
            'numero'        => ['required', 'string', 'max:20'],
            'referencia'    => ['nullable', 'string', 'max:255'],
            'distrito'      => ['required', 'string', 'max:100'],
            'provincia'     => ['required', 'string', 'max:100'],
            'departamento'  => ['required', 'string', 'max:100'],
            'codigo_postal' => ['nullable', 'string', 'max:15'],
            // Envio
            'envio'         => ['required', Rule::in(['estandar', 'express', 'recojo'])],
            // Pago
            'metodo_pago'   => ['required', Rule::in(['niubiz', 'yape', 'plin', 'cod'])],
            // Notas
            'notas'         => ['nullable', 'string', 'max:500'],
        ]);

        $cartCtrl = new CartController();
        $cart = $cartCtrl->cartActual();

        if (! $cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')
                ->with('status', 'Tu carrito está vacío.');
        }

        $costoEnvio = match ($datos['envio']) {
            'estandar' => self::ENVIO_ESTANDAR,
            'express'  => self::ENVIO_EXPRESS,
            'recojo'   => self::ENVIO_RECOJO,
        };

        $paymentMethod = PaymentMethod::where('codigo', $datos['metodo_pago'])->firstOrFail();

        try {
            $order = DB::transaction(function () use ($cart, $datos, $costoEnvio, $paymentMethod) {
                $items = $cart->items()->with('variant.product')->get();

                $subtotal = (float) $items->sum(fn ($i) => $i->precio_unitario * $i->cantidad);
                $descuento = 0.0;
                $baseConEnvio = $subtotal - $descuento + $costoEnvio;
                $igv = round($baseConEnvio - ($baseConEnvio / (1 + self::IGV_TASA)), 2);
                $total = round($baseConEnvio, 2);

                $address = Address::create([
                    'user_id'       => Auth::id(),
                    'alias'         => 'Pedido ' . now()->format('Ymd-His'),
                    'calle'         => $datos['calle'],
                    'numero'        => $datos['numero'],
                    'referencia'    => $datos['referencia'] ?? null,
                    'distrito'      => $datos['distrito'],
                    'provincia'     => $datos['provincia'],
                    'departamento'  => $datos['departamento'],
                    'codigo_postal' => $datos['codigo_postal'] ?? '00000',
                    'es_principal'  => false,
                ]);

                $estadoInicial = $datos['metodo_pago'] === 'cod' ? 'pendiente' : 'pagado';

                $order = Order::create([
                    'numero_orden'      => $this->generarNumeroOrden(),
                    'user_id'           => Auth::id(),
                    'address_id'        => $address->id,
                    'payment_method_id' => $paymentMethod->id,
                    'coupon_id'         => null,
                    'subtotal'          => $subtotal,
                    'descuento'         => $descuento,
                    'igv'               => $igv,
                    'envio'             => $costoEnvio,
                    'total'             => $total,
                    'estado'            => $estadoInicial,
                    'notas'             => $datos['notas'] ?? null,
                    'pagado_at'         => $estadoInicial === 'pagado' ? now() : null,
                ]);

                foreach ($items as $item) {
                    $variant = $item->variant;
                    $product = $variant?->product;
                    $order->items()->create([
                        'product_variant_id' => $item->product_variant_id,
                        'nombre_producto'    => $product?->nombre ?? 'Producto',
                        'cantidad'           => $item->cantidad,
                        'precio_unitario'    => $item->precio_unitario,
                        'subtotal'           => $item->precio_unitario * $item->cantidad,
                        'customization'      => $item->customization,
                    ]);

                    // Descontar stock
                    if ($variant) {
                        $variant->decrement('stock', $item->cantidad);
                    }
                }

                $order->statusHistories()->create([
                    'estado'     => $estadoInicial,
                    'comentario' => $estadoInicial === 'pagado'
                        ? 'Pago confirmado (demo)'
                        : 'Pedido recibido, pago contraentrega',
                    'user_id'    => Auth::id(),
                ]);

                // Vaciar el carrito
                $cart->items()->delete();

                return $order;
            });
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors([
                'checkout' => 'No pudimos procesar tu pedido. Intentá nuevamente. (' . $e->getMessage() . ')',
            ]);
        }

        return redirect()->route('checkout.confirmation', ['order' => $order->id]);
    }

    public function confirmation($orderId)
    {
        $order = Order::with([
                'items.variant.product.images',
                'address',
                'paymentMethod',
                'user',
            ])
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.confirmation', compact('order'));
    }

    protected function generarNumeroOrden(): string
    {
        // Formato ECO-AAAA-NNNNN, basado en fecha + contador del año
        $anio = now()->format('Y');
        $ultima = Order::where('numero_orden', 'like', "ECO-{$anio}-%")
            ->orderByDesc('id')
            ->value('numero_orden');

        $secuencia = 1;
        if ($ultima && preg_match('/ECO-\d{4}-(\d+)/', $ultima, $m)) {
            $secuencia = ((int) $m[1]) + 1;
        }

        return sprintf('ECO-%s-%05d', $anio, $secuencia);
    }
}
