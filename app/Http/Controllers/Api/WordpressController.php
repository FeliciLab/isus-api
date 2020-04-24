<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Wordpress\Projeto;
use App\Model\Wordpress\Categoria;
use Illuminate\Http\Request;

class WordpressController extends Controller
{
    public function projetos()
    {
        $data = Projeto::published()->get();

        return response()->json($data);
    }

    public function categorias()
    {
        $categoria = new Categoria();
        $data = $categoria->retornaCategorias();

        return response()->json($data);
    }

    public function projetosPorCategoria(Request $request, $categoriaid)
    {
        $projeto = new Projeto();
        $data = $projeto->retornaProjetosPorCategoria($categoriaid);

        return response()->json($data);
    }


}
