<?php
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
        ]);

    // Routes pour le panier
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Afficher le panier
        Route::post('/add/{productId}', [CartController::class, 'addProduct'])->name('cart.add'); // Ajouter un produit

        Route::delete('/remove/{productId}', [CartController::class, 'removeProduct'])->name('cart.remove'); // Supprimer un produit
        Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear'); // Vider le panier
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



// Routes d'authentification (incluses par Laravel Breeze ou autre package)
require __DIR__ . '/auth.php';
