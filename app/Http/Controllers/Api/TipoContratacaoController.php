<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\TipoContratacao;
use Exception;

class TipoContratacaoController extends Controller
{
    private $tipoContratacao;

    public function __construct(TipoContratacao $tipoContratacao)
    {
        $this->tipoContratacao = $tipoContratacao;
    }

    public function index()
    {
        try {
            $tipoContratacao = $this->tipoContratacao->all();

            return response()->json($tipoContratacao->toArray(), 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possivel retornar os dados',
            ], 500);
        }
    }
}
