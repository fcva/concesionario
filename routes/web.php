<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Provider\ProviderController;
use App\Http\Controllers\Producto\ProductoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// use App\Http\Controllers\Compra\CompraController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ruta provider
Route::get('/provider', function () {
    return Inertia::render('Provider/Index');
})->middleware(['auth', 'verified'])->name('provider');

Route::resource('/provider', ProviderController::class);
Route::resource('/producto', ProductoController::class);

// Route::resource('/compra', CompraController::class);
require __DIR__.'/auth.php';
