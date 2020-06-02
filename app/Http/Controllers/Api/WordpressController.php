<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Wordpress\Projeto;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\App;
use Illuminate\Http\Request;

class WordpressController extends Controller
{
    public function projetosPorCategoria(Request $request, $categoriaid)
    {
        $projeto = new Projeto();
        $data = $projeto->retornaProjetosPorCategoria($categoriaid);
        // Pagination
        $total = count($data);
        $step = $request->step ?? 10;
        $current_page = $request->page ?? 1;

        $paginate = $this::paginationResolver($data, $step, $total, $current_page);
        return response()->json($paginate);
    }

    public function projetoPorId(Request $request, $id)
    {
        $projeto = new Projeto();
        $projeto = $projeto->getPorId($id);

        return response()->json($projeto);
    }

    public function buscaPorProjetos(Request $request)
    {
        $projeto = new Projeto();
        $projetos = $projeto->busca($request->search);

        // Pagination
        $total = count($projetos);
        $step = $request->step ?? 10;
        $current_page = $request->page ?? 1;

        $paginate = $this::paginationResolver($projetos, $step, $total, $current_page);

       return response()->json($paginate);
    }

    public function categoriasArquitetura()
    {
        $arquitetura = [];

        $categoria = new Categoria();
        $categoriasObj = $categoria->retornaCategorias();

        $apps = App::APP;
        foreach ($apps as $key => $app) {
            foreach ($app as $categoriaId) {
                foreach ($categoriasObj as $categoriaObj) {
                    if ($categoriaObj['term_id'] == $categoriaId) {
                        $arquitetura[$key][] = $categoriaObj;
                    }
                }
            }
        }

        return response()->json($arquitetura);
    }
}
