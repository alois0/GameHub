<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;

// Homepage (Page d'accueil)
Route::get('/', [HomePageController::class, 'index'])->name('home');

// Product (Quand un produit spécifique est choisi)
Route::get('/product/{product_id}', [ProductController::class, 'show'])->name('products.show');
