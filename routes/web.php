<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () {
    return view('welcome');
});



Route::get('/api/products', [App\Http\Controllers\api\ProductController::class, 'index'])->name('products.index');
