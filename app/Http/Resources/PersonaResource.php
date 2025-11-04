<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            '_id'       => $this->_id,
            'nombres'   => $this->nombres,
            'apellidos' => $this->apellidos,
            'dni'       => $this->dni,
        ];
    }
}
