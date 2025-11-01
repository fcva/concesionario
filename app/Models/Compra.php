<?php

namespace App\Models;

use App\Models\{DetalleCompra,Persona};
use MongoDB\Laravel\Eloquent\{Builder,Model,SoftDeletes};
use MongoDB\Laravel\Relations\{HasOne,HasMany,BelongsTo,BelongsToMany};

class Compra extends Model
{
    use SoftDeletes;

    protected $primaryKey = '_id';

    protected $guarded = [];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'persona_id', '_id');
    }

    /*public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'detalle_compras', 'compra_id', 'producto_id')->withPivot(['cantidad', 'precio_unitario'])->withTimestamps();
    }*/

    public function detalleCompras(): HasMany
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id', '_id');
    }
}
