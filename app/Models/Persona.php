<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Persona extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'persona_id');
    }
}
