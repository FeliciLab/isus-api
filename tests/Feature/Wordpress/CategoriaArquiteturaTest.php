<?php

namespace Tests\Feature\Wordpress;

use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @group wordpress
 */
class CategoriaArquiteturaTest extends TestCase
{
    use RefreshDatabase;


    public function setUp(): void
    {
        parent::setUp();
    }

    public function testListaCategoriaCadastrada()
    {
        $app = new App();
        $apps = $app->getApp();
        foreach ($apps as $prefixo => $app) {
            foreach ($app as $categoriaId) {
                $categoria = factory(Categoria::class)->create([
                    'term_id' => $categoriaId
                ]);
            }
        }

        $response = $this->json('GET', 'api/categoriasArquitetura');
        $response->assertJsonCount(7);

        $response->assertJsonFragment([
            'name'      => $categoria->name,
            'term_id' => (int) $categoria->term_id,
            'slug'      => $categoria->slug,
        ]);
        $response->assertOk();
    }
}
