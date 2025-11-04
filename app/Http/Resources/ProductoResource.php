<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            '_id'       => $this->_id,
            'codigo'    => $this->codigo,
            'nombre'    => $this->nombre,
            'marca'     => $this->marca,
            'modelo'    => $this->modelo,
        ];
    }
}
