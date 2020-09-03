<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Estado;
use Exception;

class EstadoController extends Controller
{
    private $estado;

    public function __construct(Estado $estado)
    {
        $this->estado = $estado;
    }

    public function index()
    {
        try {
            $estados = $this->estado->all();

            return response()->json($estados->toArray(), 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possivel retornar os dados',
            ], 500);
        }
    }
}
