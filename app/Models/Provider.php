<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\{Builder,Model,SoftDeletes};
use MongoDB\Laravel\Relations\HasMany;

class Provider extends Model
{
    use SoftDeletes;

    protected $primaryKey = '_id';

    protected $guarded = [];

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class, 'compra_id');
    }
}
