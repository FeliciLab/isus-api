<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Municipio;
use Exception;

class MunicipioController extends Controller
{
    private $municipio;

    public function __construct(Municipio $municipio)
    {
        $this->municipio = $municipio;
    }

    public function index(int $estadoId)
    {
        try {
            $municipio = $this->municipio->where('estado_id', $estadoId)->get();

            return response()->json($municipio->toArray(), 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possivel retornar os dados',
            ], 500);
        }
    }
}
