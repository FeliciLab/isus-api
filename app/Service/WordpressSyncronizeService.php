<?php

namespace App\Service;

use App\Model\Wordpress\Anexo;
use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\CategoriaProjeto;
use App\Model\Wordpress\Projeto;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class WordpressSyncronizeService
{
    public $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function capturarImagemDoProjeto($post)
    {
        if (!isset(
            $post,
            $post->_links,
            $post->_links->{'wp:featuredmedia'},
            $post->_links->{'wp:featuredmedia'}[0]
            )) {
            return;
        }

        $resImagem = $this->client->get($post->_links->{'wp:featuredmedia'}[0]->href);
        $imageAPI = json_decode($resImagem->getBody(), false);

        return isset($imageAPI, $imageAPI->guid, $imageAPI->guid->rendered)
            ? $imageAPI->guid->rendered
            : null;
    }

    public function buscarAnexosDoPost($post)
    {
        if (!isset(
            $post,
            $post->_links,
            $post->_links->{'wp:attachment'},
            $post->_links->{'wp:attachment'}[0],
            $post->_links->{'wp:attachment'}[0]->href)) {
            return;
        }

        return json_decode(
            $this->client->get($post->_links->{'wp:attachment'}[0]->href)->getBody(),
            false
        );
    }

    public function salvarAnexos($post, $prefixo)
    {
        $anexosAPI = $this->buscarAnexosDoPost($post);
        if (!$anexosAPI) {
            return;
        }

        foreach ($anexosAPI as $anexoAPI) {
            $anexo = new Anexo();
            $anexo->projeto_id = $prefixo . $post->id;
            $anexo->link = $anexoAPI->guid->rendered;
            $anexo->save();
        }
    }

    public function salvarDadosDosProjetos($projetosAPI, $prefixo)
    {
        foreach ($projetosAPI as $post) {
            if (Projeto::find($prefixo . $post->id)) {
                continue;
            }

            $projeto = $this->salvarProjeto($post, $prefixo);
            $this->salvarAnexos($post, $prefixo);
            $this->juncaoCategoriaProjeto($post->project_category, $projeto, $prefixo);
        }
    }

    public function salvarPostsPelaCategoriaWp($categoriasAPI, $prefixo, $endpoint)
    {
        foreach ($categoriasAPI as $categoria) {
            $categoriaId = $categoria->id;
            $categoriaAPI = $this->buscarDetalheCategoriaPorCategoriaIdWp($endpoint, $categoriaId);
            $this->salvarCategoria($prefixo, $categoriaAPI);

            $this->salvarDadosDosProjetos(
                $this->buscarProjetosPorCategoriaId($endpoint, $categoriaId),
                $prefixo
            );
        }
    }

    public function sync()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement('TRUNCATE TABLE projetos');
        DB::statement('TRUNCATE TABLE categorias_projetos');
        DB::statement('TRUNCATE TABLE categorias');
        DB::statement('TRUNCATE TABLE anexos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        foreach (App::WORDPRESS_ENDPOINT as $prefixo => $endpoint) {
            $this->salvarPostsPelaCategoriaWp(
                $this->buscarTodasCategoriasWp($endpoint),
                $prefixo,
                $endpoint
            );
        }
    }

    private function buscarTodasCategoriasWp($endpoint)
    {
        $res = $this->client->get($endpoint . 'project_category/?per_page=100');

        return json_decode($res->getBody(), false);
    }

    private function buscarProjetosPorCategoriaId($endpoint, &$categoriaId)
    {
        $resProjeto = $this->client->get($endpoint . 'project/?project_category=' . $categoriaId);

        return json_decode($resProjeto->getBody(), false);
    }

    private function buscarDetalheCategoriaPorCategoriaIdWp($endpoint, $categoriaId)
    {
        $res = $this->client->get($endpoint . 'project_category/' . $categoriaId);

        return json_decode($res->getBody(), false);
    }

    private function salvarCategoria($prefixo, &$categoriaAPI)
    {
        $categoria = new Categoria();
        $categoria->term_id = $prefixo . $categoriaAPI->id;
        $categoria->name = $categoriaAPI->name;
        $categoria->slug = $categoriaAPI->slug;
        $categoria->save();
    }

    private function salvarProjeto($post, $prefixo)
    {
        $projeto = new Projeto();
        $projeto->id = $prefixo . $post->id;
        $projeto->data = $post->date;
        $projeto->post_title = html_entity_decode($post->title->rendered, ENT_NOQUOTES, 'UTF-8');
        $projeto->slug = $post->slug;
        $projeto->content = $post->content->rendered;
        $projeto->image = $this->capturarImagemDoProjeto($post);
        $projeto->save();

        return $projeto;
    }

    private function juncaoCategoriaProjeto($categoriaProjetos, $projeto, $prefixo)
    {
        foreach ($categoriaProjetos as $projetoCategoria) {
            $categoriaProjeto = new CategoriaProjeto();
            $categoriaProjeto->categoria_id = $prefixo . $projetoCategoria;
            $categoriaProjeto->projeto_id = $projeto->id;
            $categoriaProjeto->save();
        }
    }
}
