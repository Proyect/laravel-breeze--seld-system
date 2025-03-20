<?php

use App\Http\Controllers\PayController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //Product
    Route::post('/products/new', [ProductController::class,'store'])->name('products.new');
    Route::get("/products",[ProductController::class,'create'])->name('products.list');
    Route::put('/products/{id}',[ProductController::class,'update'])->name('products.update');
    Route::delete("/products/{id}",[ProductController::class,'destroy'])->name('products.delete');
  //  Route::resource('products', ProductController::class);

    //Sales
    Route::resource('sales', SalesController::class);

    // Pay
    Route::resource('pays', PayController::class);

    //Users
    Route::resource('users', UserController::class);
});
require __DIR__.'/auth.php';
