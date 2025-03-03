<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProyectoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" => [
                "type" => "Proyectos",
                "id" => (string)$this->id,
                "attributes" => [
                    "titulo" => $this->titulo,
                    "horas_previstas" => $this->horas_previstas,
                    "fecha_comienzo" => $this->fecha_comienzo,
                ],
                "links" => [
                    "self" => url("/api/proyectos/{$this->id}")
                ],
            ]
        ];
    }
}
