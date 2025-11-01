<?php

namespace App\Models;

use App\Models\{Compra,User};
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Relations\HasOne;

use MongoDB\Laravel\Eloquent\{Builder,Model,SoftDeletes};
use MongoDB\Laravel\Relations\{HasOne,HasMany,BelongsTo,BelongsToMany};

class Persona extends Model
{
    use SoftDeletes;

    protected $primaryKey = '_id';

    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'persona_id');
    }

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class, 'persona_id');
    }
}
