<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\CategoriaProfissional;
use Exception;
use Symfony\Component\HttpFoundation\Response;

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
            $categoriasProfissionais = $this->categoriaProfissional
                ->select('id', 'nome', 'ordem')
                ->orderByRaw('ordem + 0') // somente assim ele ordena com base numérica e não string
                ->get();

            return response()->json($categoriasProfissionais->toArray(), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(
                [
                    'message' => 'Não foi possivel retornar os dados',
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function especialidades($categoriaProfissionalId)
    {
        try {
            $categoriaProfissional = $this->categoriaProfissional->find($categoriaProfissionalId);
            $especialidades = $categoriaProfissional->especialidades()->get();

            return response()->json($especialidades->toArray(), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(
                [
                    'message' => 'Não foi possivel retornar os dados',
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
