<?php

use App\Models\{Compra, DetalleCompra, Persona,Producto};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {


    /*$persona = Persona::create([
        'nombres' => 'Freddy',
        'apellidos' => 'Claydermam',
        'dni' => '12345678'
    ]);

    $persona->user()->create([
        'email' => 'correo@example.com',
        'password' => bcrypt('123456')
    ]);

    return $persona;*/

    /*$producto = Producto::create([
        'codigo'    => '1001',
        'nombre'    => 'CAMIONETA',
        'marca'     => 'HYU PV LCV',
        'modelo'    => 'GRAND CRETA'
    ]);

    return $producto;*/





    /*$persona = Persona::find('690546af083e08075f0329e3');
    // return $persona->_id;

    $producto = Producto::find('690546b0083e08075f0329e9');
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
        'subtotal' => 6 * 12.50,
    ]);

    return $detalle;*/

    $compra = Compra::with(['detalleCompras.producto'])->find('69054cc0f02f7ef6090e3f31');

    return $compra;










    

    // $compra = Compra::get();
    // return $compra;

    /*$compra = Compra::create([
        'persona_id' => $persona->id,
        'fecha' => now(),
        'total' => 0, 
    ]);

    // $compra->productos()->attach($producto);

    $compra->productos()->attach($producto->id, [
        'cantidad' => 6,
        // 'precio_unitario' => $producto->precio_compra,
        // 'subtotal' => 6 * $producto->precio_compra
    ]);

    return $compra;*/

    // return DetalleCompra::get();

    // return view('welcome');
});
