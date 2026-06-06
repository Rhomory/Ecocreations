<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartCheckoutFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guest_can_add_to_cart_and_persist_in_db(): void
    {
        $product = Product::with('variants')->first();

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'cantidad'   => 2,
            'color'      => $product->variants->first()->color,
            'tamano'     => $product->variants->first()->tamano,
        ]);

        $response->assertRedirect(route('cart.index'));

        // El carrito de invitado existe (con session_id, sin user_id)
        $cart = Cart::whereNull('user_id')->whereNotNull('session_id')->first();
        $this->assertNotNull($cart);
        $this->assertEquals(1, $cart->items()->count());
        $this->assertEquals(2, $cart->items()->first()->cantidad);
    }

    public function test_logged_user_can_complete_checkout_and_creates_real_order(): void
    {
        $user = User::where('email', 'cliente@demo.pe')->first();
        $product = Product::with('variants')->first();
        $variant = $product->variants->first();
        $stockInicial = $variant->stock;

        $this->actingAs($user);

        // Agregar al carrito
        $resAdd = $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'cantidad'   => 3,
            'color'      => $variant->color,
            'tamano'     => $variant->tamano,
        ]);
        $resAdd->assertRedirect();

        $this->assertDatabaseHas('carts', ['user_id' => $user->id]);
        $cartCheck = Cart::where('user_id', $user->id)->first();
        $this->assertEquals(3, $cartCheck->items()->sum('cantidad'), 'Items deberian estar en el cart del usuario');

        // Checkout
        $response = $this->post(route('checkout.process'), [
            'nombre'        => 'Brayan Test',
            'telefono'      => '999111222',
            'email'         => $user->email,
            'calle'         => 'Av. Test',
            'numero'        => '123',
            'distrito'      => 'Surco',
            'provincia'     => 'Lima',
            'departamento'  => 'Lima',
            'envio'         => 'estandar',
            'metodo_pago'   => 'niubiz',
        ]);

        // Se creó la orden real
        $order = Order::where('user_id', $user->id)->first();
        $this->assertNotNull($order, 'Expected an order to be created');

        $response->assertRedirect(route('checkout.confirmation', ['order' => $order->id]));

        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals('pagado', $order->estado);
        $this->assertEquals(1, $order->items()->count());
        $this->assertEquals(3, $order->items()->first()->cantidad);
        $this->assertStringStartsWith('ECO-' . now()->format('Y') . '-', $order->numero_orden);

        // Carrito vaciado (el cart del usuario sigue, pero sin items)
        $cartFinal = Cart::where('user_id', $user->id)->first();
        $this->assertEquals(0, $cartFinal->items()->count());

        // Stock descontado
        $variant->refresh();
        $this->assertEquals($stockInicial - 3, $variant->stock);
    }

    public function test_guest_cart_merges_into_user_cart_on_login(): void
    {
        $product = Product::with('variants')->first();
        $user = User::where('email', 'cliente@demo.pe')->first();

        // Simular cart de invitado con un session_id conocido
        $sessionId = 'test-guest-session';
        $cartGuest = Cart::create(['session_id' => $sessionId]);
        $cartGuest->items()->create([
            'product_variant_id' => $product->variants->first()->id,
            'cantidad'           => 2,
            'precio_unitario'    => $product->precio_base,
        ]);

        // Llamar el merger directamente (el flujo real lo invoca LoginController)
        \App\Http\Controllers\CartController::fusionarCarritoEnLogin($user->id, $sessionId);

        $cartUsuario = Cart::where('user_id', $user->id)->first();

        $this->assertNotNull($cartUsuario);
        $this->assertEquals(2, $cartUsuario->items()->sum('cantidad'));

        // El cart de invitado fue eliminado
        $this->assertEquals(0, Cart::where('session_id', $sessionId)->count());
    }
}
