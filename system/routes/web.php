<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

//product
Route::get('products/',[ProductController::class,'index'])->name('products.index');
Route::post('/products/new', [ProductController::class,'store'])->name('products.new');
Route::get("/products/list",[ProductController::class,'create'])->name('products.list');
Route::put('/products/{id}',[ProductController::class,'update'])->name('products.update');
Route::delete("/products/{id}",[ProductController::class,'destroy'])->name('products.delete');
