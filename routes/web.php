<?php

use App\Http\Controllers\Compra\CompraController;
use App\Http\Controllers\ProfileController;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Persona;
use App\Models\Producto;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/execute', function() {

    /*$persona = Persona::create([
        'nombres' => 'Friedrich',
        'apellidos' => 'Gauss',
        'dni' => '234523'
    ]);*/

    /*$persona = Persona::find('690a0206f5002bc91500c9c3'); 
    // return $persona->_id;

    $producto = Producto::find('690a0207f5002bc91500c9c9'); 
    // return $producto->_id;

    $compra = Compra::create([ 
        'persona_id' => $persona->_id, 
        'fecha' => now(), 
        'total' => 0, 
    ]);

    $detalle = DetalleCompra::create([ 
        'compra_id' => $compra->_id, 
        'producto_id' => $producto->_id, 
        'cantidad' => 6, 
        'precio_compra' => 12.50, 
        'subtotal' => 6 * 12.50
    ]);

    return $detalle;*/
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::resource('/compras', CompraController::class)->names([
        'index'     => 'compras.index',
        'store'     => 'compras.store',
        'update'    => 'compras.update',
        'destroy'   => 'compras.destroy',
    ]);
});

require __DIR__.'/auth.php';
