<?php

namespace Lab\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipoResource extends JsonResource
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
            'no_piezas' => $this->no_piezas,
            'eliminado' => (string) $this->eliminado,
            'mantenimiento1' => (string) $this->mantenimiento1,
            'mantenimiento2' => (string) $this->mantenimiento2,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
          ];
    }
}
