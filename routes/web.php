<?php

use Illuminate\Support\Facades\Route;
use App\Https\Controllers\homepage;
use App\Https\Controllers\Productpage;
use App\Https\Controllers\Checkoutpage;

//Hompage(Page d'acceuil)
Route::get('/', [homepage::class, 'index']);

//Product(Quand un produit specific est choisi)
Route::get('/produits/{product_name}', [Productpage::class, 'show' ]);

//Checkout(cart pour finaliser la commande)
Route::get('/cart', [Checkoutpage::class, 'index']);