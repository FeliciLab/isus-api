<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;

use Corcel\Model\Taxonomy as CorcelTaxonomy;

class WordpressController extends Controller
{
    public function posts()
    {
        $data = Post::published()->get();

        return response()->json($data);
    }

    public function categorias()
    {
        $data = array();

        $categoriasPai = CorcelTaxonomy::where('taxonomy', 'project_category')->where('parent', 0)->get();
        foreach ($categoriasPai as $categoriaPai) {
            $subCategorias = CorcelTaxonomy::where('taxonomy', 'project_category')->where('parent', $categoriaPai->term_id)->get();

            $subCategoriasA = null;
            foreach ($subCategorias as $subcategoria) {
                $subCategoriasA[] = $subcategoria->term;
            }

            $dataA['categoria'] = $categoriaPai->term;
            $dataA['categoria']['subcategorias'] = $subCategoriasA;

            $data[] = $dataA;
        }

        return response()->json($data);
    }


}
