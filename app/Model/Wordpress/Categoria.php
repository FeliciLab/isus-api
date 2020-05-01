<?php

namespace App\Model\Wordpress;

use Corcel\Model\Taxonomy;

class Categoria extends Taxonomy
{
    public function retornaCategorias()
    {
        $data = array();

        $categoriasPai = self::where('taxonomy', 'project_category')->where('parent', 0)->get();
        foreach ($categoriasPai as $categoriaPai) {
            $subCategorias = self::where('taxonomy', 'project_category')->where('parent', $categoriaPai->term_id)->get();

            $subCategoriasA = null;
            foreach ($subCategorias as $subcategoria) {
                $subCategoriasA[] = $subcategoria->term;
            }

            $dataA['categoria'] = $categoriaPai->term;
            $dataA['categoria']['subcategorias'] = $subCategoriasA;

            $data[] = $dataA;
        }

        return $data;
    }

    public function retornaCategoria($id)
    {
        return self::where('taxonomy', 'project_category')->where('term_id', $id)->get();;
    }
}
