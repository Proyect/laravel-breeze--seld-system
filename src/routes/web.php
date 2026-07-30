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

Route::get('/site', [SiteConstroller::class, 'index'])->name('site.index');
Route::get('/site/{site}', [SiteConstroller::class, 'getSite'])->name('site.detail');
Route::post('/search', [SiteConstroller::class, 'search'])->name('site.search');

Route::post('/contacto', [ContactController::class, 'submit'])
    ->middleware('throttle:10,1')
    ->name('contact.submit');

Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
Route::get('/servicios/{slug}', [ServicioController::class, 'detalle'])->name('servicios.detalle');
Route::post('/servicios/{slug}/relevamiento', [ServicioController::class, 'relevamiento'])
    ->middleware('throttle:10,1')
    ->name('servicios.relevamiento');

Route::get('/api/tecnologias/{categoria}', [ServicioController::class, 'tecnologiasPorCategoria'])
    ->middleware('throttle:60,1')
    ->name('api.tecnologias.categoria');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/payments', [PayController::class, 'index'])->name('payments.index');
    Route::post('/payments', [PayController::class, 'store'])
        ->middleware('throttle:20,1')
        ->name('payments.store');
    Route::get('/payments/success', [PayController::class, 'success'])->name('payments.success');
    Route::get('/payments/cancel', [PayController::class, 'cancel'])->name('payments.cancel');
});

Route::post('/webhooks/mercadopago', [MercadoPagoWebhookController::class, 'handle'])
    ->name('webhooks.mercadopago');
Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handle'])
    ->name('webhooks.stripe');
