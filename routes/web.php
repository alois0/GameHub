<?php

use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Route pour la page d'accueil (redirige vers /home)
Route::get('/', function () {
    return redirect()->route('home'); // Redirige vers 'home'
})->name('welcome');

// Route vers la page d'accueil après connexion
Route::get('/home', function () {
    return view('home'); // Afficher la vue 'home.blade.php' après connexion
})->name('home');

// Groupement des routes nécessitant une authentification
Route::middleware(['auth', 'verified'])->group(function () {

    // Tableau de bord
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gestion du profil
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Routes pour les numéros de téléphone
    Route::prefix('users/{userId}/phones')->group(function () {
        Route::get('/', [PhoneController::class, 'index'])->name('phones.index');
        Route::get('/create', [PhoneController::class, 'create'])->name('phones.create');
        Route::post('/', [PhoneController::class, 'store'])->name('phones.store');
        Route::post('/add', [PhoneController::class, 'addPhone'])->name('phones.add');
    });

    Route::prefix('phones')->group(function () {
        Route::get('{phoneId}/edit', [PhoneController::class, 'edit'])->name('phones.edit');
        Route::put('{phoneId}', [PhoneController::class, 'update'])->name('phones.update');
        Route::delete('{phoneId}', [PhoneController::class, 'destroy'])->name('phones.destroy');
    });

    // Routes pour les produits
    Route::resource('products', ProductController::class)
        ->names([ 
            'index' => 'products.index', 
            'create' => 'products.create',
            'store' => 'products.store',
            'show' => 'products.show', 
            'edit' => 'products.edit', 
            'update' => 'products.update', 
            'destroy' => 'products.destroy', // Add this line to complete the resource routes
        ]);

    // Routes pour le panier
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Afficher le panier
        Route::post('/add/{productId}', [CartController::class, 'addProduct'])->name('cart.add'); // Ajouter un produit
        Route::delete('/remove/{productId}', [CartController::class, 'removeProduct'])->name('cart.remove'); // Supprimer un produit
        Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear'); // Vider le panier
        Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    });

    // Routes pour les catégories
    Route::resource('categories', CategoryController::class)
        ->except(['destroy'])
        ->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'show' => 'categories.show',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
        ]);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Route pour le checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
// Route pour traiter la commande (POST)
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::middleware(['auth'])->group(function () {
    // Afficher toutes les commandes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    
    // Annuler une commande
    Route::delete('/orders/{orderId}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('orders.show');

// Route pour le paiement
Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/process', [PaymentController::class, 'process']);

Route::get('/confirmation', function () {
    return view('payment.confirmation'); // Spécifier le dossier "payment"
});

// Route pour les reviews 
Route::post('/products/{id}/reviews', [ProductReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

// Route pour l'admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::resource('admin/orders', AdminOrderController::class)->names([
        'index' => 'admin.orders.index',
        'create' => 'admin.orders.create',
        'store' => 'admin.orders.store',
        'show' => 'admin.orders.show',
        'edit' => 'admin.orders.edit',
        'update' => 'admin.orders.update',
        'destroy' => 'admin.orders.destroy',
    ]);

    Route::resource('admin/products', AdminProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);

    Route::resource('admin/categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    Route::resource('admin/platforms', PlatformController::class)->names([
        'index' => 'admin.platforms.index',
        'create' => 'admin.platforms.create',
        'store' => 'admin.platforms.store',
        'show' => 'admin.platforms.show',
        'edit' => 'admin.platforms.edit',
        'update' => 'admin.platforms.update',
        'destroy' => 'admin.platforms.destroy',
    ]);

    Route::resource('admin/users', AdminUserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/choose-address', [CheckoutController::class, 'chooseAddress'])->name('checkout.choose_address');
    Route::post('/checkout/store-address', [CheckoutController::class, 'storeAddress'])->name('checkout.store_address');
});

// Route pour l'adresse
Route::middleware(['auth'])->group(function () {
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
});

// Routes d'authentification (incluses par Laravel Breeze ou autre package)
require __DIR__ . '/auth.php';