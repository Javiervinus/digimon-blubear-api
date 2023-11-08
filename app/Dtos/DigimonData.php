<?php

namespace App\Dtos;

use App\Dtos\FieldData;

class DigimonData
{
    public int $id;
    public string $name;
    public ?string $image;
    public ?string $level;
    public ?string $type;
    public ?string $attribute;
    public ?array $fields;

    public function __construct($attributes)
    {
        $this->id = $attributes['id'] ?? null;
        $this->name = $attributes['name'] ?? null;
        // Obtenemos la imagen de la primera imagen del array de imágenes
        $this->image = $attributes['image'] ?? $attributes['images'][0]['href'] ?? null;
        // Obtenemos el nivel, tipo y atributo de la primera posición de sus respectivos arrays
        $this->level = $attributes['levels'][0]['level'] ?? null;
        $this->type = $attributes['types'][0]['type'] ?? null;
        $this->attribute = $attributes['attributes'][0]['attribute'] ?? null;
        $this->fields = array_map(function ($field) {
            return new FieldData($field);
        }, $attributes['fields'] ?? []);
    }
}
