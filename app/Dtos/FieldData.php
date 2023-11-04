<?php

namespace App\Dtos;

class FieldData
{
    public int $id;
    public string $name;
    public string $img;
    public string $color;

    /**
     * Mapa de colores para los campos.
     *
     * @var array
     */
    protected static $colorMap = [
        'Nature Spirits' => '#478F5F',
        'Virus Busters' => '#C9BCAF',
        'Wind Guardians' => '#55A2B4',
        'Unknown' => '#FFFFFF',
        'Metal Empire' => '#A6A4A3',
        'Deep Savers' => '#4267A2',
        'Nightmare Soldiers' => '#444881',
        'Dark Area' => '#000000',
        "Dragon's Roar" => '#E53B3B',
        'Jungle Troopers' => '#B6C861',
    ];

    public function __construct($attributes)
    {
        $this->id = $attributes['id'] ?? 0; // Valor por defecto en caso de que no esté definido
        $this->name = $attributes['name'];
        $this->img = $attributes['img'];
        $this->color = $this->determineColor($attributes);
    }

    /**
     * Determina el color del campo basado en su nombre.
     *
     * @param  array  $attributes
     * @return string
     */
    private function determineColor($attributes): string
    {
        // Si el campo no está definido en el mapa de colores, se devuelve blanco
        return self::$colorMap[$attributes['name']] ?? '#FFFFFF';
    }
}
