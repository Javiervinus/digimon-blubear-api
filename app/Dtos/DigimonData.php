<?php

namespace App\Dtops;

use App\Dtos\FieldData;

class DigimonData
{
    public int $id;
    public string $name;
    public string $img;
    public ?string $level;
    public ?string $type;
    public ?string $attribute;
    public ?array $fields;

    public function __construct($attributes)
    {
        $this->id = $attributes['id'] ?? null;
        $this->name = $attributes['name'] ?? null;
        $this->img = $attributes['img'] ?? null;
        $this->level = $attributes['level'] ?? null;
        $this->type = $attributes['type'] ?? null;
        $this->attribute = $attributes['attribute'] ?? null;
        $this->fields = array_map(function ($field) {
            return new FieldData($field);
        }, $attributes['fields'] ?? []);
    }
}
