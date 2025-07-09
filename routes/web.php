<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; // <-- PASTIKAN BARIS INI ADA!
use App\Http\Controllers\SaleController; // <-- PASTIKAN BARIS INI ADA!


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Cukup satu baris ini saja untuk semua rute CRUD Produk:
    Route::resource('products', ProductController::class); // <-- HANYA PERTAHANKAN BARIS INI
});

require __DIR__.'/auth.php';
