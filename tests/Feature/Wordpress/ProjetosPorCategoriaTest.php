<?php

namespace Tests\Feature\Wordpress;

use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\CategoriaProjeto;
use App\Model\Wordpress\Projeto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group wordpress
 */
class ProjetosPorCategoriaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testProjetosPorCategoriaSemParametro()
    {
        $response = $this->json('GET', 'api/projetosPorCategoria/');
        $response->assertNotFound();
    }

    public function testProjetosPorCategoriaComProjetoInexistente()
    {
        $response = $this->json('GET', 'api/projetosPorCategoria/0');
        $response->assertOk();
        $response->assertJsonFragment([
            'total' => 0,
        ]);
    }

    public function testProjetosPorCategoriaComProjetoExistente()
    {
        $app = new App();
        $apps = $app->getApp();
        foreach ($apps as $key => $app) {
            foreach ($app as $categoriaId) {
                $categoria = factory(Categoria::class)->create([
                    'term_id' => $categoriaId,
                ]);

                $categorias = Categoria::all();
                foreach ($categorias as $categoria) {
                    $projeto = factory(Projeto::class)->create();

                    $categoriaProjeto = new CategoriaProjeto();
                    $categoriaProjeto->projeto_id = $projeto->id;
                    $categoriaProjeto->categoria_id = $categoria->term_id;
                    $categoriaProjeto->save();
                }
            }
        }

        $response = $this->json('GET', "api/projetosPorCategoria/{$categoria->term_id}");
        $response->assertJsonFragment([
            'content' => $projeto->content,
        ]);
        $response->assertOk();
    }
}
