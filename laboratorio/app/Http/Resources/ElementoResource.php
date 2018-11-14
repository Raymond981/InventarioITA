<?php

namespace Lab\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ElementoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tipo' => $this->tipo,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'no_serie' => $this->no_serie,
            'cantidad' => (string) $this->cantidad,
            'eliminado' => (string) $this->eliminado,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
          ];
          
    }
}
