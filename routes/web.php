<?php
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\AddressController;




Route::get('/users', [UserController::class, 'index'])->name('users.index');


// Route pour la page d'accueil (redirige vers /home)
Route::get('/', function () {
    return redirect()->route('home'); // Redirige vers 'home'
})->name('welcome');

// Route vers la page d'accueil après connexion
Route::get('/home', function () {
    return view('home'); // Afficher la vue 'home.blade.php' après connexion
})->name('home');

// Routes pour les produits (accessible sans authentification)
Route::resource('products', ProductController::class)
    ->names([ 
        'index' => 'products.index', 
        'create' => 'products.create',
        'store' => 'products.store',
        'show' => 'products.show', 
        'edit' => 'products.edit', 
        'update' => 'products.update', 
    ]);

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

//route pour le detail du produit

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

//route pour les reviews 

Route::post('/products/{id}/reviews', [ProductReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');









//route pour l'admin


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/orders/{id}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::post('/admin/orders/{id}/update-status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    
    // Routes pour les catégories

    Route::prefix('admin/categories')->name('admin.categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index'); // Affiche toutes les catégories
        Route::get('/create', [CategoryController::class, 'create'])->name('create'); // Formulaire de création
        Route::post('/', [CategoryController::class, 'store'])->name('store'); // Enregistre une nouvelle catégorie
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit'); // Formulaire d'édition
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update'); // Met à jour une catégorie
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy'); // Supprime une catégorie
    });


    //route pour les produit 


    //route pour les plateformes

    Route::resource('platforms', PlatformController::class);
    
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/choose-address', [CheckoutController::class, 'chooseAddress'])->name('checkout.choose_address');
    Route::post('/checkout/store-address', [CheckoutController::class, 'storeAddress'])->name('checkout.store_address');
});



   //route pour l'addresse

Route::middleware(['auth'])->group(function () {
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
});


 
// Routes d'authentification (incluses par Laravel Breeze ou autre package)
require __DIR__ . '/auth.php';

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
