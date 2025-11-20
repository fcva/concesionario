<?php

namespace App\Http\Controllers\Provider;

use App\Http\Resources\ProviderResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
class ProviderController extends Controller
{
    //
    public function index(Request $request) {

        $per_page= request()->get('per_page') ?: 9;

        // consulta de proveedores
        $providers=Provider::paginate($per_page);
        return Inertia::render('Provider/Index', [
            'providers'=>ProviderResource::collection($providers)
        ]);
    }

    public function create(Request $request) {

        return Inertia::render('Provider/Create', [
        ]);
    }

    public function store(Request $request) {
        // validación de datos
        $valiacion=$request->validate([
            'nombre'    => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono'  => 'required|string|max:20',
        ]);
        // lógica para almacenar un nuevo proveedor
        $providers=Provider::create($valiacion);

        return Redirect::route('provider.index');
    }

    public function edit(Provider $provider) {

        return Inertia::render('Provider/Edit', [
            'provider'=> $provider,
        ]);
    }

    public function update(Request $request, Provider $provider) {
        // validación de datos
        $valiacion=$request->validate([
            'nombre'    => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono'  => 'required|string|max:20',
        ]);
        // lógica para actualizar un proveedor
        $provider->update($valiacion);

        return Redirect::route('provider.index');
    }
}
