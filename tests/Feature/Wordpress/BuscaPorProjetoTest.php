<?php

namespace Tests\Feature\Wordpress;

use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\Projeto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BuscaPorProjetoTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $apps = App::getApp();
        foreach ($apps as $key => $app) {
            foreach ($app as $categoriaId) {
                $categoria = factory(Categoria::class)->create([
                    'term_id' => $categoriaId
                ]);

            }
        }
    }

    public function testBuscaPorProjetosSemParametro()
    {
        $response = $this->json('GET', 'api/buscaPorProjetos');
        $response->assertOk();
        $response->assertJsonFragment([
            'current_page' => 1
        ]);
    }

    public function testBuscaPorProjetosComParametro()
    {

        $projeto = factory(Projeto::class)->create();

        $response = $this->json('GET', "api/buscaPorProjetos?search={$projeto->post_title}");
        $response->assertOk();
        $response->assertJsonFragment([
            'post_title' => $projeto->post_title
        ]);
    }
}
