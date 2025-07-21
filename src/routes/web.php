<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteConstroller;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('site.index');
});

//site
Route::get("/site", [SiteConstroller::class,"index"])->name('site.index');
Route::get('/site/{$site}',[SiteConstroller::class,'getSite'])->name('site.detail');
Route::post('/search/',[SiteConstroller::class,'search'])->name('site.search');
Route::post('/contacto', [ContactController::class, 'submit'])->name('contact.submit');
