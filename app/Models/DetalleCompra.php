<?php

namespace App\Models;

use App\Models\{Compra,Producto};
use MongoDB\Laravel\Eloquent\{Builder,Model,SoftDeletes};
use MongoDB\Laravel\Relations\{HasOne,HasMany,BelongsTo,BelongsToMany};

class DetalleCompra extends Model
{
    use SoftDeletes;

    protected $primaryKey = '_id';

    protected $guarded = [];

    // public function productos(): BelongsToMany
    // {
    //     return $this->belongsToMany(Producto::class, 'detalle_compras', 'compra_id', 'producto_id')->withPivot(['cantidad', 'precio_unitario'])->withTimestamps();
    // }

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class, 'compra_id', '_id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id', '_id');
    }
}
