<?php

namespace Tests\Feature\Wordpress;

use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\Projeto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjetosPorCategoriaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testProjetosPorCategoriaSemParametro()
    {
        $response = $this->json('GET', "api/projetosPorCategoria/");
        $response->assertNotFound();
    }

    public function testProjetosPorCategoriaComProjetoInexistente()
    {
        $response = $this->json('GET', "api/projetosPorCategoria/0");
        $response->assertOk();
        $response->assertJsonFragment([
            'total' => 0
        ]);
    }


    public function testProjetosPorCategoriaComProjetoExistente()
    {
        $apps = App::APP;
        foreach ($apps as $key => $app) {
            foreach ($app as $categoriaId) {
                $categoria = factory(Categoria::class)->create([
                    'term_id' => $categoriaId
                ]);

                $categorias = Categoria::all();
                foreach ($categorias as $categoria) {
                    $projeto = factory(Projeto::class)->create([
                        'categoria_id' => $categoria->term_id
                    ]);
                }
            }
        }

        $response = $this->json('GET', "api/projetosPorCategoria/{$categoria->term_id}");
        $response->assertJsonFragment([
            'categoria_id' => $categoria->term_id
        ]);
        $response->assertOk();
    }
}
