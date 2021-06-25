<?php

namespace App\Http\Controllers;

use App\Model\Wordpress\Projeto;

class WordpressPostagemController extends Controller
{
    public function index(int $id)
    {
        $postagem = Projeto::findOrFail($id);

        return view(
            'wordpres_post',
            [
                'postagem' => $postagem->content,
                'titulo' => $postagem->post_title,
                'imagem' => $postagem->image,
            ]
        );
    }
}
