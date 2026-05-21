<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (cualquier visitante)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalogo/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

Route::get('/producto/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/sobre-nosotros', [PageController::class, 'about'])->name('page.about');

Route::get('/contacto', [PageController::class, 'contact'])->name('page.contact');
Route::post('/contacto', [PageController::class, 'sendContact'])->name('page.contact.send');

// Páginas legales
Route::get('/terminos', [PageController::class, 'terms'])->name('page.terms');
Route::get('/privacidad', [PageController::class, 'privacy'])->name('page.privacy');
Route::get('/envios', [PageController::class, 'shipping'])->name('page.shipping');
Route::get('/devoluciones', [PageController::class, 'returns'])->name('page.returns');


/*
|--------------------------------------------------------------------------
| Rutas de Autenticación (login, registro, logout)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/registro', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/registro', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Rutas del Cliente (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Carrito
    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrito/agregar', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/carrito/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/carrito/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/pagar', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/confirmacion/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

    // Mi cuenta
    Route::get('/cuenta', [AccountController::class, 'index'])->name('account.index');
    Route::get('/cuenta/pedidos', [AccountController::class, 'orders'])->name('account.orders');
    Route::get('/cuenta/pedidos/{order}', [AccountController::class, 'orderDetail'])->name('account.order.detail');
    Route::get('/cuenta/direcciones', [AccountController::class, 'addresses'])->name('account.addresses');
});


/*
|--------------------------------------------------------------------------
| Rutas del Admin (requieren login + role=admin)
|--------------------------------------------------------------------------
| El middleware 'admin' lo crearemos después.
| Por ahora solo usamos 'auth'.
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('productos', AdminProductController::class)->parameters(['productos' => 'product']);

        Route::get('/pedidos', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/pedidos/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/pedidos/{order}/estado', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

        Route::resource('categorias', AdminCategoryController::class)->parameters(['categorias' => 'category']);

        Route::resource('cupones', AdminCouponController::class)->parameters(['cupones' => 'coupon']);
    });
