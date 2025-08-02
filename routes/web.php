<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CosmeticController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cosmetics/create', [CosmeticController::class, 'create'])->name('cosmetics.create');
Route::post('/cosmetics', [CosmeticController::class, 'store'])->name('cosmetics.store');

Route::get('/cosmetics', [CosmeticController::class, 'index'])->name('cosmetics.index');