<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Wordpress\Post;
use App\Model\Wordpress\Categoria;

class WordpressController extends Controller
{
    public function posts()
    {
        $data = Post::published()->get();

        return response()->json($data);
    }

    public function categorias()
    {
        $categoria = new Categoria();
        $data = $categoria->retornaCategorias();

        return response()->json($data);
    }


}
