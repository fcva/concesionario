<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class ProviderController extends Controller
{
    //
    public function index(Request $request) {

        // $per_page = request()->get('per_page') ?: 9;

        // $compras = Compra::with('user.persona','detalleCompras.producto')->paginate($per_page);

        // return $compras;
    
        return Inertia::render('Provider/Index', [
        ]);
    }
}
