<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteConstroller;

Route::get('/', function () {
    return view('welcome');
});

//site
Route::get("/site", [SiteConstroller::class,"index"])->name('site.index');
Route::get('/site/{$site}',[SiteConstroller::class,'getSite'])->name('site.detail');
Route::post('/search/',[SiteConstroller::class,'search'])->name('site.search');
