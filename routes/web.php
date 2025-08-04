<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CosmeticController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/cosmetics', [CosmeticController::class, 'index'])->name('cosmetics.index');
    Route::get('/cosmetics/create', [CosmeticController::class, 'create'])->name('cosmetics.create');
    Route::post('/cosmetics', [CosmeticController::class, 'store'])->name('cosmetics.store');
});

require __DIR__.'/auth.php';
