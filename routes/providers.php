<?php

use App\Http\Controllers\Provider\ProviderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::resource('/providers', ProviderController::class)->names([
        'index'     => 'providers.index',
        'store'     => 'providers.store',
        'update'    => 'providers.update',
        'destroy'   => 'providers.destroy',
    ]);
});