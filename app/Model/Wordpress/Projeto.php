<?php

namespace App\Model\Wordpress;

use GuzzleHttp\Client;

class Projeto
{
    public function retornaProjetosPorCategoria($categoriaid)
    {
        $client = new Client();
        $res = $client->get(App::WORDPRESS_ENDPOINT . 'project/?project_category=' . $categoriaid);

        $projetosAPI = json_decode($res->getBody(), false);

        $projetos = [];
        $projetosPublicados = [];
        foreach ($projetosAPI as $post) {
            $resImagem = $client->get($post->_links->{'wp:attachment'}[0]->href);
            $imageAPI = json_decode($resImagem->getBody(), false);

            $projetosPublicados[] = [
                'id' => $post->id,
                'data' => $post->date,
                'post_title' => $post->title->rendered,
                'slug' => $post->slug,
                'content' => $post->content->rendered,
                'image' => $imageAPI[0]->guid->rendered,
            ];
        }

        $projetos = $projetosPublicados;

        return $projetos;
    }


    public function getPorId($projetoId)
    {
        $client = new Client();
        $res = $client->get( App::WORDPRESS_ENDPOINT . 'project/' . $projetoId);
        $projetoAPI = json_decode($res->getBody(), false);

        $resImagem = $client->get($projetoAPI->_links->{'wp:attachment'}[0]->href);
        $imageAPI = json_decode($resImagem->getBody(), false);

        $projeto = [
            'id' => $projetoAPI->id,
            'slug' => $projetoAPI->slug,
            'post_date' => $projetoAPI->date,
            'post_title' => $projetoAPI->title->rendered,
            'post_status' => $projetoAPI->status,
            'image' => $imageAPI[0]->guid->rendered,
            'post_content' => $projetoAPI->content->rendered
        ];

        return $projeto;
    }

    public function busca($search)
    {
        $client = new Client();
        $res = $client->get( App::WORDPRESS_ENDPOINT . 'project/?search=' . $search);
        $projetosAPI = json_decode($res->getBody(), false);

        $projetosPublicados = [];

        foreach ($projetosAPI as $post) {
            $resImagem = $client->get($post->_links->{'wp:attachment'}[0]->href);
            $imageAPI = json_decode($resImagem->getBody(), false);

            $projetosPublicados[] = [
                'ID' => $post->id,
                'data' => $post->date,
                'post_title' => $post->title->rendered,
                'slug' => $post->slug,
                'content' => $post->content->rendered,
                'image' => $imageAPI[0]->guid->rendered,
            ];
        }

        return $projetosPublicados;
    }
}
