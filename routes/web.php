<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CosmeticController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route:: middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cosmetics', [CosmeticController::class, 'index'])->name('cosmetics.index');
    Route::get('/cosmetics/create', [CosmeticController::class, 'create'])->name('cosmetics.create');
    Route::post('/cosmetics', [CosmeticController::class, 'store'])->name('cosmetics.store');
    Route::get('/cosmetics/{cosmetic}', [CosmeticController::class, 'show'])->name('cosmetics.show');
    Route::delete(('/cosmetics/{cosmetic}'), [CosmeticController::class, 'destroy'])->name('cosmetics.destroy');
    Route::get('/cosmetics/{cosmetic}/edit', [CosmeticController::class, 'edit'])->name('cosmetics.edit');
    Route::patch('/cosmetics/{cosmetic}', [CosmeticController::class, 'update'])->name('cosmetics.update');
    Route::patch('/cosmetics/{cosmetic}/favorite', [CosmeticController::class, 'toggleFavorite'])->name('cosmetics.favorite');
});

require __DIR__.'/auth.php';
