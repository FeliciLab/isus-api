<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\UnidadeServico;
use Exception;

class UnidadeServicoController extends Controller
{
    private $unidadeServico;

    public function __construct(UnidadeServico $unidadeServico)
    {
        $this->unidadeServico = $unidadeServico;
    }

    public function index()
    {
        try {
            $unidadeServico = $this->unidadeServico->all();

            return response()->json($unidadeServico->toArray(), 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possivel retornar os dados',
            ], 500);
        }
    }
}
