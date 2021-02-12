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
            // TODO: metodo buscarCategoriasWp
            $client = new Client();
            $res = $client->get($endpoint . 'project_category/?per_page=100');
            $categoriasAPI = json_decode($res->getBody(), false);

            foreach ($categoriasAPI as $categoria) {
                $categoriaId = $categoria->id;

                //TODO: metodo buscarDetalheCategoriaPorCatewgoriaIDWp
                $client = new Client();
                $res = $client->get($endpoint . 'project_category/' . $categoriaId);
                $categoriaAPI = json_decode($res->getBody(), false);

                // TODO: metodo salvarCategoria
                $categoria = new Categoria();
                $categoria->term_id = $prefixo . $categoriaAPI->id;
                $categoria->name = $categoriaAPI->name;
                $categoria->slug = $categoriaAPI->slug;
                $categoria->save();

                // TODO: metodo buscarProjetosPorCategoriaId
                $clientProjeto = new Client();
                $resProjeto = $clientProjeto->get($endpoint . 'project/?project_category=' . $categoriaId);
                $projetosAPI = json_decode($resProjeto->getBody(), false);

                // TODO: metodo salvarDadosDosProjetos
                foreach ($projetosAPI as $post) {
                    $projetoExiste = Projeto::find($prefixo . $post->id);
                    if (!isset($projetoExiste)) {
                        $projeto = $this->salvarProjeto($post, $prefixo);

                        // TODO: metodo CapturarImagemDoProjeto
                        // try {
                        //     $this->capturarImagem($post, $projeto);
                        //     // dd($projeto->image);
                        // } catch (ServerException $e) {
                        //     $projeto->image = null;
                        //     // dd($e->getMessage());
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

                        //TODO: metodo categoriaProjetoTemp
                        foreach ($post->project_category as $projetoCategoria) {
                            $categoriasProjetosTemp[] = [
                                'categoria_id' => $prefixo . $projetoCategoria,
                                'projeto_id' => $projeto->id,
                            ];
                        }
                    }
                }
            }
            //TODO: metodo juncaoCategoriaProjeto
            foreach ($categoriasProjetosTemp as $categoriaProjetoTemp) {
                $this->juncaoCategoriaProjeto($categoriaProjetoTemp);
            }
        }
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
        $resImagem = $clientImage->get($post->_links->{'wp:featuredmedia'}[0]->href);
        if ($resImagem === null) {
            throw new ServerException('Erro ao capturar a imagem', $resImagem);

            return $clientImage;
        }
        $imageAPI = json_decode($resImagem->getBody(), false);
        $projeto->image = $imageAPI->guid->rendered;
        $projeto->save();
    }

    private function juncaoCategoriaProjeto(&$categoriaProjetoTemp)
    {
        $categoriaProjeto = new CategoriaProjeto();
        $categoriaProjeto->categoria_id = $categoriaProjetoTemp['categoria_id'];
        $categoriaProjeto->projeto_id = $categoriaProjetoTemp['projeto_id'];
        $categoriaProjeto->save();
    }
}
