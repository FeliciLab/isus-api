<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Instituicao;
use Exception;

class InstituicaoController extends Controller
{
    private $instituicao;

    public function __construct(Instituicao $instituicao)
    {
        $this->instituicao = $instituicao;
    }

    public function index()
    {
        try{
            $instituicoes = $this->instituicao->all();

            return response()->json($instituicoes->toArray(), 200);
        } catch(Exception $e){
            return response()->json([
                'message' => 'Não foi possivel retornar os dados',
            ], 500);
        }

    }
}
