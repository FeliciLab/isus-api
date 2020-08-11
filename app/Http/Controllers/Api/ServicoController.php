<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Servico;
use Exception;

class ServicoController extends Controller
{
    private $servico;

    public function __construct(Servico $servico)
    {
        $this->servico = $servico;
    }

    public function index()
    {
        try {
            $servico = $this->servico->all();

            return response()->json($servico->toArray(), 200);
        } catch(Exception $e){
            return response()->json([
                'message' => 'Não foi possivel retornar os dados',
            ], 500);
        }

    }
}
