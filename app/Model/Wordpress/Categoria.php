<?php

namespace App\Model\Wordpress;

use GuzzleHttp\Client;

class Categoria
{
    public function retornaCategorias()
    {
        $client = new Client();
        $res = $client->get(App::WORDPRESS_ENDPOINT . 'project_category/?per_page=100');
        $categoriaAPI = json_decode($res->getBody(), false);
        foreach ($categoriaAPI as $cat) {
            $categorias[] = [
                'term_id' => $cat->id,
                'name' => $cat->name,
                'slug' => $cat->slug,
            ];
        }

        return $categorias;
    }
}
