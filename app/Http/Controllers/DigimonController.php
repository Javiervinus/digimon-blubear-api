<?php

namespace App\Http\Controllers;

use App\Services\DigimonTransformerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DigimonController extends Controller
{
    protected $digimonTransformerService;
    public function __construct(DigimonTransformerService $digimonTransformerService)
    {
        $this->digimonTransformerService = $digimonTransformerService;
    }

    public function index(Request $request)
    {
        try {
            $page = $request->query('page', 1);
            $name = $request->query('name', '');
            $response = Http::get(
                'https://digi-api.com/api/v1/digimon',
                // add pageSize to query params
                [
                    'page' => $page,
                    'pageSize' => 30,
                    'name' => $name
                ]
            );
            if ($response->successful()) {
                // pregunta si existe content
                if (!array_key_exists('content', $response->json())) {
                    return response()->json(['data' => []]);
                }
                $data = $response->json()['content'];
                $digimons = $this->digimonTransformerService->transformApiListResponseToDigimonDataArray($data);
                return response()->json(['data' => $digimons]);
            }
        } catch (\Throwable $th) {

            return response()->json(['error' => 'Error al obtener los datos'], 500);
        }
    }

    public function show($id)
    {
        $response = Http::get('https://digi-api.com/api/v1/digimon/' . $id);
        if ($response->successful()) {
            $data = $response->json();
            $digimon = $this->digimonTransformerService->transformApiResponseToDigimonData($data);
            return response()->json(['data' => $digimon]);
        }
        return response()->json(['error' => 'Error al obtener los datos'], 500);
    }
}
