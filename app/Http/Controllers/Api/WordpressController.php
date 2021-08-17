<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WordpressController extends Controller
{
    private $step = 20;

    public function projetosPorCategoria(Request $request, $categoriaId)
    {
        $categoria = Categoria::where('term_id', $categoriaId)->first();

        $projetosPublicados = [];

        if (isset($categoria)) {
            foreach ($categoria->categoriaProjetos as $categoriaProjeto) {
                $projetosPublicados[] = $categoriaProjeto->projeto()->first();
            }
        }

        // Pagination
        $total = count($projetosPublicados);
        $step = $request->step ?? $this->step;
        $current_page = $request->page ?? 1;

        $paginate = $this::paginationResolver($projetosPublicados, $step, $total, $current_page);

        return response()->json($paginate);
    }

    public function projetoPorId(Request $request, $id)
    {
        $projeto = Projeto::find($id);

        return response()->json([
            'id' => $projeto->id,
            'slug' => $projeto->slug,
            'post_date' => $projeto->data,
            'post_title' => $projeto->post_title,
            'post_content' => $projeto->content,
            'image' => $projeto->image,
            'anexos' => $projeto->anexos()->get(),
        ]);
    }

    public function buscaPorProjetos(Request $request)
    {
        $search = $request->search ?? ' ';

        $projetos = Projeto::query()
                ->where('post_title', 'LIKE', "%{$search}%")
                ->orWhere('content', 'LIKE', "%{$search}%")->get();

        $projetosSearch = [];
        foreach ($projetos as $projeto) {
            $projetosSearch[] = [
                'id' => $projeto->id,
                'post_link' => Arr::get($projeto, 'post_link', ''),
                'data' => $projeto->data,
                'post_title' => $projeto->post_title,
                'image' => $projeto->image,
            ];
        }

        $total = count($projetosSearch);
        $step = $request->step ?? $this->step;
        $current_page = $request->page ?? 1;

        $paginate = $this::paginationResolver($projetosSearch, $step, $total, $current_page);

        return response()->json($paginate);
    }

    /**
     * @OA\Get(
     *      path="/categoriasArquitetura",
     *      operationId="categoriasArquitetura",
     *      tags={"Wordpress"},
     *      summary="Macro projetos",
     *      description="Retorna arquitetura de macro projetos",
     *      @OA\Response(
     *          response=200,
     *          description="",
     *          content={
     *              @OA\MediaType(
     *                  mediaType="application/json",
     *                  @OA\Schema(
     *                      example={
     *                          "Educação": {
     *                               {
     *                                  "term_id": 451,
     *                                  "name": "Cursos on-line",
     *                                  "slug": "cursos-on-line",
     *                                  "created_at": "2020-09-17T18:39:21.000000Z",
     *                                  "updated_at": "2020-09-17T18:39:21.000000Z"
     *                               },
     *                              {
     *                               "term_id": 452,
     *                               "name": "Tutoriais",
     *                               "slug": "tutoriais",
     *                               "created_at": "2020-09-17T18:42:28.000000Z",
     *                               "updated_at": "2020-09-17T18:42:28.000000Z"
     *                               },
     *                          },
     *                      }
     *                  )
     *              )
     *          }
     *       )
     * )
     *
     * @param Request $request
     */
    public function categoriasArquitetura(Request $request)
    {
        $arquitetura = [];

        $app = new App();
        $apps = $app->getApp($request->v2 === 'true');

        foreach ($apps as $key => $app) {
            foreach ($app as $categoriaId) {
                $arquitetura[$key][] = Categoria::where('term_id', $categoriaId)->first();
            }
        }

        return response()->json($arquitetura);
    }
}
