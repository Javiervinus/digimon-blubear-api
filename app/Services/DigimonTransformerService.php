<?php

namespace App\Services;

use App\Dtos\DigimonData;

class DigimonTransformerService
{
    /**
     * Transforma la respuesta de la API para un Digimon en un DigimonData DTO.
     *
     * @param array $digimonAttributes
     * @return DigimonData
     */
    public function transformApiResponseToDigimonData(array $digimonAttributes): DigimonData
    {
        return new DigimonData($digimonAttributes);
    }

    /**
     * Transforma la respuesta de la API para una lista de Digimon en un array de DigimonData DTO.
     *
     * @param array $digimonList
     * @return array
     */
    public function transformApiListResponseToDigimonDataArray(array $digimonList): array
    {
        return array_map(function ($digimonAttributes) {
            return $this->transformApiResponseToDigimonData($digimonAttributes);
        }, $digimonList);
    }
}
