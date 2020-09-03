<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\CategoriaProfissional;
use Exception;

class CategoriaProfissionalController extends Controller
{
    private $categoriaProfissional;

    public function __construct(CategoriaProfissional $categoriaProfissional)
    {
        $this->categoriaProfissional = $categoriaProfissional;
    }

    public function index()
    {
        try {
            $categoriasProfissionais = $this->categoriaProfissional->all();

            return response()->json($categoriasProfissionais->toArray(), 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possivel retornar os dados',
            ], 500);
        }
    }
}
