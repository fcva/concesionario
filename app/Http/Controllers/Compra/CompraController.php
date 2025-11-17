<?php

namespace App\Http\Controllers\Compra;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompraResource;
use App\Http\Resources\ProductoResource;
use App\Http\Resources\ProviderResource;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CompraController extends Controller
{
    public function index(Request $request) {

        $per_page = request()->get('per_page') ?: 9;

        $compras = Compra::with('user.persona','detalleCompras.producto')->paginate($per_page);

        // return $compras;
    
        return Inertia::render('Compras/Index', [
            'compras' => CompraResource::collection($compras),
            // 'compras'   => $compras,
            'providers' => Inertia::lazy(fn () => ProviderResource::collection(Provider::get())),
            'productos' => Inertia::lazy(fn () => ProductoResource::collection(Producto::get()))
        ]);
    }

    public function store(Request $request) {

        // $compra = Compra::create([]);

        $user_id = Auth::user()->id;
        $provider_id = $request->provider_id;

        $compra = Compra::create([ 
            'user_id'       => $user_id,
            'provider_id'   => $provider_id, 
            'fecha'         => now(), 
            'total'         => 0, 
        ]);

        $producto_id = $request->producto_id;

        $detalle = DetalleCompra::create([ 
            'compra_id'     => $compra->_id, 
            'producto_id'   => $producto_id, 
            'cantidad'      => $request->cantidad, 
            'precio_compra' => $request->precio_compra, 
            'subtotal'      => ''
        ]);

        return back()->with('success','ok');
    }
}
