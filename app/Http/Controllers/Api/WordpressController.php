<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Wordpress\Projeto;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\App;
use Illuminate\Http\Request;

class WordpressController extends Controller
{
    public function projetos(Request $request)
    {
        $data = Projeto::published()->paginate($request->step ?? 10);
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
        // Pagination
        $total = count($data);
        $step = $request->step ?? 10;
        $current_page = $request->page ?? 1;

        $paginate = $this::paginationResolver($data, $step, $total, $current_page);
        return response()->json($paginate);
    }

    public function projetoPorId(Request $request, $id)
    {
        $projeto = Projeto::find($id);

        $projeto = [
            'id' => $projeto->ID,
            'slug' => $projeto->slug,
            'post_date' => $projeto->post_date,
            'post_title' => $projeto->post_title,
            'post_status' => $projeto->post_status,
            'image' => $projeto->image,
            'keywords' => $projeto->keywords,
            'post_content' => $projeto->post_content
        ];
        return response()->json($projeto);
    }

    public function buscaPorProjetos(Request $request) {

        $search = $request->search ?? ' ';
        //buscando os campos
        $projetos = Projeto::select('*')
        ->where(function($query) use ($search) {
            return $query
            ->orWhere('post_title', 'like', '%'.$search.'%')
            ->orWhere('post_excerpt', 'like', '%'.$search.'%')
            ->orWhere('post_content', 'like', '%'.$search.'%');
        })->published()->paginate($request->step ?? 10);

       return response()->json($projetos);
    }

    public function categoriasArquitetura()
    {
        $arquitetura = [];

        $categoria = new Categoria();

        $apps = App::APP;
        foreach ($apps as $key => $app) {
            foreach ($app as $categoriaId) {
                $cat = $categoria->retornaCategoria($categoriaId);
                if (!empty($cat[0])) {
                    $arquitetura[$key][] = $cat[0]->term;
                }

            }
        }

        return response()->json($arquitetura);
    }
}
