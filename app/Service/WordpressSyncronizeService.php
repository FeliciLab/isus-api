<?php

namespace App\Service;

use App\Model\Wordpress\Anexo;
use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\CategoriaProjeto;
use App\Model\Wordpress\Projeto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\DB;

class WordpressSyncronizeService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function sync()
    {
        $this->truncateTables();

        foreach (App::WORDPRESS_ENDPOINT as $prefixo => $endpoint) {
            $categoriasAPI = $this->getCategoriasWp($endpoint);

            $categoriasProjetosTemp = [];

            foreach ($categoriasAPI as $categoria) {
                if ($prefixo === 200
                    && ($categoria->slug === 'biblioteca'
                    || $categoria->slug === 'instrucoes')) {
                    continue;
                }

                $categoriaId = $categoria->id;

                $this->salvaCategorias($endpoint, $prefixo, $categoriaId);

                $projetosAPI = $this->projetosPorCategoriaWp($endpoint, $categoriaId);

                $categoriasProjetosTemp[] = $this->percorreProjetos($projetosAPI, $prefixo);
            }

            $this->salvaVinculosCategoriasProjetos($categoriasProjetosTemp);
        }
    }

    private function salvaVinculosCategoriasProjetos($categoriasProjetosTemp)
    {
        foreach ($categoriasProjetosTemp as $categoriaProjetoTemp) {
            foreach ($categoriaProjetoTemp as $categoriaProjetoTempProj) {
                $categoriaProjeto = new CategoriaProjeto();
                $categoriaProjeto->categoria_id = $categoriaProjetoTempProj['categoria_id'];
                $categoriaProjeto->projeto_id = $categoriaProjetoTempProj['projeto_id'];
                $categoriaProjeto->save();
            }
        }
    }

    private function truncateTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement('TRUNCATE TABLE projetos');
        DB::statement('TRUNCATE TABLE categorias_projetos');
        DB::statement('TRUNCATE TABLE categorias');
        DB::statement('TRUNCATE TABLE anexos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    private function getCategoriasWp($endpoint)
    {
        $res = $this->client->get($endpoint . 'project_category/?per_page=100');

        return json_decode($res->getBody(), false);
    }

    private function salvaCategorias($endpoint, $prefixo, $categoriaId)
    {
        $res = $this->client->get($endpoint . 'project_category/' . $categoriaId);
        $categoriaAPI = json_decode($res->getBody(), false);

        $categoria = new Categoria();
        $categoria->term_id = $prefixo . $categoriaAPI->id;
        $categoria->name = $categoriaAPI->name;
        $categoria->slug = $categoriaAPI->slug;
        $categoria->save();

        return $categoria;
    }

    private function projetosPorCategoriaWp($endpoint, $categoriaId)
    {
        $resProjeto = $this->client->get($endpoint . 'project/?project_category=' . $categoriaId);

        return json_decode($resProjeto->getBody(), false);
    }

    private function salvaAnexo($post, $prefixo)
    {
        $resAnexo = $this->client->get($post->_links->{'wp:attachment'}[0]->href);
        $anexosAPI = json_decode($resAnexo->getBody(), false);
        foreach ($anexosAPI as $anexoAPI) {
            $anexo = new Anexo();
            $anexo->projeto_id = $prefixo . $post->id;
            $anexo->link = $anexoAPI->guid->rendered;
            $anexo->save();
        }
    }

    private function capturarImagemDoProjeto($post)
    {
        if (!isset(
            $post,
            $post->_links,
            $post->_links->{'wp:featuredmedia'},
            $post->_links->{'wp:featuredmedia'}[0]
            )) {
            return;
        }

        try {
            $resImagem = $this->client->get($post->_links->{'wp:featuredmedia'}[0]->href);
        } catch (BadResponseException $err) {
            return;
        }
        $imageAPI = json_decode($resImagem->getBody(), false);

        return isset($imageAPI, $imageAPI->guid, $imageAPI->guid->rendered)
            ? $imageAPI->guid->rendered
            : null;
    }

    private function salvaProjeto($prefixo, $post)
    {
        $projeto = new Projeto();
        $projeto->id = $prefixo . $post->id;
        $projeto->post_link = $post->link;
        $projeto->data = $post->date;
        $projeto->post_title = html_entity_decode($post->title->rendered, ENT_NOQUOTES, 'UTF-8');
        $projeto->slug = $post->slug;
        $projeto->content = $post->content->rendered;
        $projeto->image = $this->capturarImagemDoProjeto($post);

        $projeto->save();

        $this->salvaAnexo($post, $prefixo);

        return $projeto;
    }

    private function percorreProjetos($projetosAPI, $prefixo)
    {
        $categoriasProjetosTemp = [];
        foreach ($projetosAPI as $post) {
            $projetoExiste = Projeto::find($prefixo . $post->id);
            if (!isset($projetoExiste)) {
                $projeto = $this->salvaProjeto($prefixo, $post);

                foreach ($post->project_category as $projetoCategoria) {
                    $categoriasProjetosTemp[] = [
                        'categoria_id' => $prefixo . $projetoCategoria,
                        'projeto_id' => $projeto->id,
                    ];
                }
            }
        }

        return $categoriasProjetosTemp;
    }
}
