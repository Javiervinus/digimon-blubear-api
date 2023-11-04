<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DigimonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'img' => $this->img,
            'level' => $this->level,
            'type' => $this->type,
            'attribute' => $this->attribute,
            'fields' => FieldDataResource::collection($this->fields),
        ];
    }
}
