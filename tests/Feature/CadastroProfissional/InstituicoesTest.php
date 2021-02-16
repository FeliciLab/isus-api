<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstituicoesTest extends TestCase
{
    use RefreshDatabase;

    public function testRetornaTodasInstituicoes()
    {
        $this->seed();

        $response = $this->json('GET', 'api/instituicoes');
        $response->assertOk();
        $response->assertJsonFragment([
            'nome' => 'Hospital Leonardo da Vinci'
        ]);
        $response->assertJsonStructure([
            [
                'id',
                'nome'
            ]
        ]);
    }
}
