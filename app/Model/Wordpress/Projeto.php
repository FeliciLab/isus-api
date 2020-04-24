<?php

namespace App\Model\Wordpress;

use Corcel\Model\Post;
use App\Model\Wordpress\Categoria;

class Projeto extends Post
{
    protected $postType = 'project';

    public function retornaProjetosPorCategoria($categoriaid)
    {
        $categorias = Categoria::where('taxonomy', 'project_category')
                                ->where('term_id', $categoriaid)
                                ->get();

        foreach ($categorias as $categoria) {
            $projetosPublicados = [];
            foreach ($categoria->posts as $post) {
                if ($post->post_status == 'publish') {
                    $projetosPublicados[] = [
                        'id' => $post->ID,
                        'data' => $post->post_date,
                        'post_title' => $post->post_title,
                        'slug' => $post->slug,
                        'content' => $post->content,
                        'image' => $post->image,
                        'terms' => $post->terms,
                        'keywords' => $post->keywords
                    ];
                }
            }

            $projetos[] = $projetosPublicados;
        }
        return $projetos;
    }
}
