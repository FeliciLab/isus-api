<?php

namespace Tests\Feature\Wordpress;

use App\Model\Wordpress\Projeto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BuscaPorProjetoTest extends TestCase
{
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
        $response = $this->json('GET', 'api/buscaPorProjetos?search=covid');
        $response->assertOk();
        $response->assertJsonFragment([
            'post_title' => 'Saúde Ceará disponibiliza curso sobre prevenção e controle de infecções'
        ]);
    }
}
