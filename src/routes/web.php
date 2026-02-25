<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteConstroller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\MercadoPagoWebhookController;
use App\Http\Controllers\StripeWebhookController;

Route::get('/', function () {
    return view('site.index');
});

//site
Route::get("/site", [SiteConstroller::class,"index"])->name('site.index');
Route::get('/site/{$site}',[SiteConstroller::class,'getSite'])->name('site.detail');
Route::post('/search/',[SiteConstroller::class,'search'])->name('site.search');
Route::post('/contacto', [ContactController::class, 'submit'])->name('contact.submit');

// Servicios
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
Route::get('/servicios/{slug}', [ServicioController::class, 'detalle'])->name('servicios.detalle');
Route::post('/servicios/{slug}/relevamiento', [ServicioController::class, 'relevamiento'])->name('servicios.relevamiento');

// API para tecnologías
Route::get('/api/tecnologias/{categoria}', [ServicioController::class, 'tecnologiasPorCategoria'])->name('api.tecnologias.categoria');

// Pagos (protegidos por auth en escenarios reales)
Route::middleware('auth')->group(function () {
    Route::get('/payments', [PayController::class, 'index'])->name('payments.index');
    Route::post('/payments', [PayController::class, 'store'])->name('payments.store');
});

// Webhooks para pasarelas de pago
Route::post('/webhooks/mercadopago', [MercadoPagoWebhookController::class, 'handle'])->name('webhooks.mercadopago');
Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handle'])->name('webhooks.stripe');
