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
        $this->image = $attributes['image'] ?? $attributes['images'][0]['href'] ?? null;
        $this->level = $attributes['levels'][0]['level'] ?? null;
        $this->type = $attributes['types'][0]['type'] ?? null;
        $this->attribute = $attributes['attributes'][0]['attribute'] ?? null;
        $this->fields = array_map(function ($field) {
            return new FieldData($field);
        }, $attributes['fields'] ?? []);
    }
}
