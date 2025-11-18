<?php

use App\Http\Controllers\Compra\CompraController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::resource('/compras', CompraController::class)->names([
        'index'     => 'compras.index',
        'store'     => 'compras.store',
        'update'    => 'compras.update',
        'destroy'   => 'compras.destroy',
    ]);
});