<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\TitulacaoAcademica;
use Exception;

class TitulacaoAcademicaController extends Controller
{
    private $titulacaoAcademica;

    public function __construct(TitulacaoAcademica $titulacaoAcademica)
    {
        $this->titulacaoAcademica = $titulacaoAcademica;
    }

    public function index()
    {
        try {
            $titulacaoAcademica = $this->titulacaoAcademica->all();

            return response()->json($titulacaoAcademica->toArray(), 200);
        } catch(Exception $e){
            return response()->json([
                'message' => 'Não foi possivel retornar os dados',
            ], 500);
        }

    }
}
