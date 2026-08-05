<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MercadoPagoWebhookController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SiteConstroller;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('site.index');
});

// Sitio público
Route::get('/site', [SiteConstroller::class, 'index'])->name('site.index');
Route::get('/site/{site}', [SiteConstroller::class, 'getSite'])->name('site.detail');
Route::post('/search', [SiteConstroller::class, 'search'])->name('site.search');
Route::post('/contacto', [ContactController::class, 'submit'])->name('contact.submit');

// Servicios
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
Route::get('/servicios/{slug}', [ServicioController::class, 'detalle'])->name('servicios.detalle');
Route::post('/servicios/{slug}/relevamiento', [ServicioController::class, 'relevamiento'])->name('servicios.relevamiento');
Route::get('/api/tecnologias/{categoria}', [ServicioController::class, 'tecnologiasPorCategoria'])->name('api.tecnologias.categoria');

// Webhooks (sin CSRF)
Route::post('/webhooks/mercadopago', [MercadoPagoWebhookController::class, 'handle'])->name('webhooks.mercadopago');
Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handle'])->name('webhooks.stripe');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pagos
    Route::get('/payments', [PayController::class, 'index'])->name('payments.index');
    Route::post('/payments', [PayController::class, 'store'])->name('payments.store');
    Route::get('/payments/success', [PayController::class, 'success'])->name('payments.success');
    Route::get('/payments/cancel', [PayController::class, 'cancel'])->name('payments.cancel');

    // Ventas (usuarios autenticados)
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
    Route::get('/sales/{sales}', [SalesController::class, 'show'])->name('sales.show');
    Route::put('/sales/{sales}', [SalesController::class, 'update'])->name('sales.update');
    Route::delete('/sales/{sales}', [SalesController::class, 'destroy'])->name('sales.destroy');
    Route::get('/sales-list/data', [SalesController::class, 'list'])->name('sales.list');

    // Admin
    Route::middleware('admin')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

require __DIR__.'/auth.php';
