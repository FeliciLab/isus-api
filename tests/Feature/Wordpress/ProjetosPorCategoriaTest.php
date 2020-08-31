<?php

namespace Tests\Feature\Wordpress;

use App\Model\Wordpress\Projeto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjetosPorCategoriaTest extends TestCase
{
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
        $projetos = Projeto::all();
        $projeto = $projetos->first();

        $response = $this->json('GET', "api/projetosPorCategoria/{$projeto->categoria_id}");
        $response->assertOk();
    }
}
