<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('apiProduct'); //cRud
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('apiDeleteProduct'); //cruD
Route::post('/products', [ProductController::class, 'store'])->name('apiCreateProduct'); //Crud