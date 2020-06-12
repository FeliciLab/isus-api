<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Model\Wordpress\App;

use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\Projeto;

class SynchronizeController extends Controller
{
    const WORDPRESS_ENDPOINT = 'https://coronavirus.ceara.gov.br/wp-json/wp/v2/';

    public function index()
    {
        $apps = App::APP;

        \DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        \DB::statement("TRUNCATE TABLE projetos");
        \DB::statement("TRUNCATE TABLE categorias");
        \DB::statement("SET FOREIGN_KEY_CHECKS = 1");


        foreach ($apps as $key => $app) {
            foreach ($app as $categoriaId) {
                $client = new Client();
                $res = $client->get(self::WORDPRESS_ENDPOINT . 'project_category/' . $categoriaId);
                $categoriaAPI = json_decode($res->getBody(), false);

                $categoria = new Categoria();
                $categoria->term_id = $categoriaAPI->id;
                $categoria->name = $categoriaAPI->name;
                $categoria->slug = $categoriaAPI->slug;
                $categoria->save();


                $clientProjeto = new Client();
                $resProjeto = $clientProjeto->get(self::WORDPRESS_ENDPOINT . 'project/?project_category=' . $categoriaId);
                $projetosAPI = json_decode($resProjeto->getBody(), false);

                foreach ($projetosAPI as $post) {
                    $projeto = new Projeto();
                    $projeto->id = $post->id;
                    $projeto->data = $post->date;
                    $projeto->post_title = html_entity_decode($post->title->rendered, ENT_NOQUOTES, 'UTF-8');;
                    $projeto->slug = $post->slug;
                    $projeto->content = $post->content->rendered;

                    try {
                        $clientImage = new Client();
                        $resImagem = $clientImage->get($post->_links->{'wp:featuredmedia'}[0]->href);
                        $imageAPI = json_decode($resImagem->getBody(), false);
                        $projeto->image = $imageAPI->guid->rendered;
                    } catch (\Exception $e) {
                        $projeto->image = null;
                    }

                    $projeto->categoria_id = $categoriaId;

                    $projeto->save();
                }
            }
        }

    }
}
