<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductoResource;
use Illuminate\Http\Request;
use App\Models\Producto;
use Inertia\Inertia;

class ProductoController extends Controller
{
    //
    public function index(Request $request) {

        $per_page= request()->get('per_page') ?: 9;

        // consulta de productos
        $productos=Producto::paginate($per_page);
        return Inertia::render('Producto/Index', [
            'productos'=>ProductoResource::collection($productos)
        ]);
    }

    public function create(Request $request) {

        return Inertia::render('Producto/Create', [
        ]);
    }

    public function store(Request $request) {
        // validación de datos
        $valiacion=$request->validate([
            'codigo'    => 'required|string|unique:productos,codigo',
            'nombre' =>  'required|string|max:50',
            'marca'  => 'required|string|max:50',
            'modelo'  => 'required|string|max:20',
        ]);
        

        // lógica para almacenar un nuevo producto
        $productos=Producto::create($valiacion);

        return Redirect::route('producto.index');
    }
}
