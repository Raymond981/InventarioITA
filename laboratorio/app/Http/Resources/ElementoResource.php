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
            'clase' => $this->clase,
            'estado_fisico' => $this->estado_fisico,
            'formula_quimica' => $this->formula_quimica,
            'no_serie' => $this->no_serie,
            'no_piezas' => $this->no_piezas,
            'cantidad' => (string) $this->cantidad,
            'unidad_medida' => $this->unidad_medida,
            'eliminado' => (string) $this->eliminado,
            'mantenimiento1' => (string) $this->mantenimiento1,
            'mantenimiento2' => (string) $this->mantenimiento2,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
          ];
    }
}
