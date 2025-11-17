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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id', '_id');
    }

    public function detalleCompras(): HasMany
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id', '_id');
    }
}
