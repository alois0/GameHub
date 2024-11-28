<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhoneController; // Ajouter le contrôleur des téléphone
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les numéros de téléphone
    Route::get('/users/{userId}/phones', [PhoneController::class, 'index'])->name('phones.index');
    Route::get('/users/{userId}/phones/create', [PhoneController::class, 'create'])->name('phones.create');
    Route::post('/users/{userId}/phones', [PhoneController::class, 'store'])->name('phones.store');
    Route::post('/users/{userId}/phones/add', [PhoneController::class, 'addPhone'])->name('phones.add');
    Route::get('/phones/{phoneId}/edit', [PhoneController::class, 'edit'])->name('phones.edit');
    Route::put('/phones/{phoneId}', [PhoneController::class, 'update'])->name('phones.update');
    Route::delete('/phones/{phoneId}', [PhoneController::class, 'destroy'])->name('phones.destroy');
});

require __DIR__.'/auth.php';
