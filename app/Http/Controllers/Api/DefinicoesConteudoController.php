<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\DefinicoesConteudosService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class DefinicoesConteudoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $categoria
     * @param DefinicoesConteudosService $definicoesConteudosService
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $categoria, DefinicoesConteudosService $definicoesConteudosService)
    {
        return response()->json($definicoesConteudosService->buscar($categoria));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param DefinicoesConteudosService $definicoesConteudosService
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, DefinicoesConteudosService $definicoesConteudosService)
    {
        $validacao = Validator::make(
            $request->all(),
            [
                'ativo' => 'required',
                'categoria' => 'required',
                'imagem' => 'required',
                'ordem' => 'required',
                'sessao' => 'required',
                'tipo' => 'required',
                'titulo' => 'required',
                'valor' => 'required',
            ]
        );

        if ($validacao->fails()) {
            return response()->json(
                $validacao->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }

        return $definicoesConteudosService->salvar($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id_publico
     * @param DefinicoesConteudosService $definicoesConteudosService
     * @param string $categoria
     *
     * @return \Illuminate\Http\Response
     */
    public function show(
        DefinicoesConteudosService $definicoesConteudosService,
        string $categoria,
        string $id_publico = ''
    ) {
        return response()->json($definicoesConteudosService->buscar($categoria, $id_publico));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_publico
     * @param DefinicoesConteudosService $definicoesConteudosService
     * @param string $categoria
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        DefinicoesConteudosService $definicoesConteudosService,
        string $categoria,
        string $id_publico
    ) {
        return response()->json(
            $definicoesConteudosService->atualizar(
                $categoria,
                $id_publico,
                $request->all()
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $categoria
     * @param  string  $id_publico
     * @param DefinicoesConteudosService $definicoesConteudosService
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DefinicoesConteudosService $definicoesConteudosService, string $categoria, string $id_publico)
    {
        return response()->json($definicoesConteudosService->deletar($categoria, $id_publico));
    }
}
