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
    public function index(Request $request) {

        $per_page= request()->get('per_page') ?: 9;

        // consulta de proveedores
        $providers=Provider::paginate($per_page);
        return Inertia::render('Provider/Index', [
            'providers'=>ProviderResource::collection($providers)
        ]);
    }

    public function store(Request $request) {
        
        $request->validate([
            'nombre'    => 'required|string|max:255',
        ]);

        $providers = Provider::create($request->all());

        return back()->with('success','ok');
    }

    public function update(Request $request, Provider $provider) {

        $request->validate([
            'nombre'    => 'required|string|max:255',
        ]);

        $provider->update($request->all());

        return back()->with('success','ok');
    }

    public function destroy(Provider $provider) {

        $provider->delete();

        return back()->with('success','ok');
    }
}
