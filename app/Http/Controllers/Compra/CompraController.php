<?php

namespace App\Http\Controllers\Compra;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompraResource;
use App\Http\Resources\PersonaResource;
use App\Http\Resources\ProductoResource;
use App\Models\Compra;
use App\Models\Persona;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CompraController extends Controller
{
    public function index(Request $request) {

        $per_page = request()->get('per_page') ?: 9;

        $compras = Compra::with('persona','detalleCompras')->paginate($per_page);
    
        return Inertia::render('Compras/Index', [
            'compras' => CompraResource::collection($compras),
            'personas' => Inertia::lazy(fn () => PersonaResource::collection(Persona::get())),
            'productos' => Inertia::lazy(fn () => ProductoResource::collection(Producto::get()))
        ]);
    }

    public function store(Request $request) {

        // $compra = Compra::create([]);

        return $request->all();
    }
}
