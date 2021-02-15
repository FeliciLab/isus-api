<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Wordpress\Anexo;
use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\CategoriaProjeto;
use App\Model\Wordpress\Projeto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

class SynchronizeController extends Controller
{
    public function index()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::statement('TRUNCATE TABLE projetos');
        \DB::statement('TRUNCATE TABLE categorias_projetos');
        \DB::statement('TRUNCATE TABLE categorias');
        \DB::statement('TRUNCATE TABLE anexos');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        foreach (App::WORDPRESS_ENDPOINT as $prefixo => $endpoint) {
            $categoriasAPI = $this->buscarTodasCategoriasWp($endpoint);

            foreach ($categoriasAPI as $categoria) {
                $categoriaId = $categoria->id;

                $categoriaAPI = $this->buscarDetalheCategoriaPorCategoriaIdWp($endpoint, $categoriaId);

                $this->salvarCategoria($prefixo, $categoriaAPI);

                $projetosAPI = $this->buscarProjetosPorCategoriaId($endpoint, $categoriaId);

                // TODO: metodo salvarDadosDosProjetos
                // ERROR: Invalid argument suplied for foreach();
                // line 123 - foreach ($categoriasProjetosTemp as $categoriaProjetoTemp)             
                foreach ($projetosAPI as $post) {
                    $projetoExiste = Projeto::find($prefixo . $post->id);
                    if (!isset($projetoExiste)) {
                        $projeto = $this->salvarProjeto($post, $prefixo);

                        // TODO: metodo CapturarImagemDoProjeto
                        // ERROR: std::wp:featuredmedia doesn't recognized
                        // try {
                        //     $clientImage = $this->capturarImagem($post, $projeto);
                        // } catch (ServerException $e) {
                        //     $projeto->image = null;
                        //     dd($e->getMessage());
                        // }
                        try {
                            $clientImage = new Client();
                            $resImagem = $clientImage->get($post->_links->{'wp:featuredmedia'}[0]->href);
                            $imageAPI = json_decode($resImagem->getBody(), false);
                            $projeto->image = $imageAPI->guid->rendered;
                        } catch (\Exception $e) {
                            $projeto->image = null;
                        }
                        $projeto->save();

                        // TODO: metodo buscarAnexosDoProjeto
                        $clientAnexo = new Client();
                        $resAnexo = $clientAnexo->get($post->_links->{'wp:attachment'}[0]->href);
                        $anexosAPI = json_decode($resAnexo->getBody(), false);

                        foreach ($anexosAPI as $anexoAPI) {
                            $anexo = new Anexo();
                            $anexo->projeto_id = $prefixo . $post->id;
                            $anexo->link = $anexoAPI->guid->rendered;
                            $anexo->save();
                        }

                        // TODO: metodo categoriaProjetoTemp
                        // ERROR: Salva de forma incompleta no banco de dados a tabela categorias_projetos
                        // $categoriasProjetosTemp = $this->converterCategoriasProjetosArray($post, $prefixo, $projeto);
                        foreach ($post->project_category as $projetoCategoria) {
                            $categoriasProjetosTemp[] = [
                                'categoria_id' => $prefixo . $projetoCategoria,
                                'projeto_id' => $projeto->id,
                            ];
                        }
                    }
                }
            }

            $this->juncaoCategoriaProjeto($categoriasProjetosTemp);
        }
    }

    private function buscarTodasCategoriasWp($endpoint)
    {
        $client = new Client();
        $res = $client->get($endpoint . 'project_category/?per_page=100');
        return json_decode($res->getBody(), false);
    }

    private function buscarProjetosPorCategoriaId($endpoint, &$categoriaId)
    {
        $clientProjeto = new Client();
        $resProjeto = $clientProjeto->get($endpoint . 'project/?project_category=' . $categoriaId);
        return json_decode($resProjeto->getBody(), false);
    }

    private function buscarDetalheCategoriaPorCategoriaIdWp($endpoint, $categoriaId)
    {
        $client = new Client();
        $res = $client->get($endpoint . 'project_category/' . $categoriaId);
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

        return $projeto;
    }

    private function capturarImagem(&$post, &$projeto)
    {
        $clientImage = new Client();
        var_dump($post->_links);
        $resImagem = $clientImage->get($post->_links->{'wp:featuredmedia'}[0]->href);
        if ($resImagem === null) {
            throw new ServerException('Erro ao capturar a imagem', $resImagem);

            return $clientImage;
        }
        $imageAPI = json_decode($resImagem->getBody(), false);
        $projeto->image = $imageAPI->guid->rendered;
        $projeto->save();
    }

    private function buscarAnexoProjeto($post, $prefixo)
    {
        $clientAnexo = new Client();
        $resAnexo = $clientAnexo->get($post->_links->{'wp:attachment'}[0]->href);
        $anexosAPI = json_decode($resAnexo->getBody(), false);

        foreach ($anexosAPI as $anexoAPI) {
            $anexo = new Anexo();
            $anexo->projeto_id = $prefixo . $post->id;
            $anexo->link = $anexoAPI->guid->rendered;
            $anexo->save();
        }        
    }

    private function converterCategoriasProjetosArray(&$post, $prefixo, &$projeto)
    {
        foreach ($post->project_category as $projetoCategoria) {
            $categoriasProjetosTemp[] = [
                'categoria_id' => $prefixo . $projetoCategoria,
                'projeto_id' => $projeto->id,
            ];
        }
        return $categoriasProjetosTemp;
    }

    private function juncaoCategoriaProjeto(&$categoriasProjetosTemp)
    {
        foreach ($categoriasProjetosTemp as $categoriaProjetoTemp) {
            $categoriaProjeto = new CategoriaProjeto();
            $categoriaProjeto->categoria_id = $categoriaProjetoTemp['categoria_id'];
            $categoriaProjeto->projeto_id = $categoriaProjetoTemp['projeto_id'];
            $categoriaProjeto->save();
        }
    }
}
