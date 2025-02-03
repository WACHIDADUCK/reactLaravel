<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Policies\ProductPolicy;
use App\Http\Controllers\api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/products', [App\Http\Controllers\api\ProductController::class, 'index'])
->name('products.index')->middleware('auth:sanctum');

Route::delete('/products/{product}', [App\Http\Controllers\api\ProductController::class, 'destroy'])
->middleware('auth:sanctum');
