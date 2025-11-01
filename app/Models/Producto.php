<?php

namespace App\Models;

use App\Models\{Compra};
use MongoDB\Laravel\Eloquent\{Builder,Model,SoftDeletes};
use MongoDB\Laravel\Relations\{HasOne,HasMany,BelongsTo,BelongsToMany};

class Producto extends Model
{
    use SoftDeletes;

    protected $primaryKey = '_id';

    protected $guarded = [];

    /*public function compras(): BelongsToMany
    {
        return $this->belongsToMany(Compra::class, 'detalle_compras', 'producto_id', 'compra_id')
                    ->withPivot(['cantidad', 'precio_unitario'])
                    ->withTimestamps();
    }*/

    /*public function detalleCompras(): HasMany
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id', '_id');
    }*/

    public function detalleCompras(): HasMany
    {
        return $this->hasMany(DetalleCompra::class, 'producto_id', '_id');
    }
}
