<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            '_id'           => $this->_id,
            'nombre'        => $this->nombre,
            'direccion'     => $this->direccion,
            'telefono'      => $this->telefono,
            'compras'       => $this->compras,
        ];
    }
}
