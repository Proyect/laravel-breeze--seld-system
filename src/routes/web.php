<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteConstroller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicioController;

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
