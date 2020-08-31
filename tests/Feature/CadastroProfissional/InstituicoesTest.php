<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstituicoesTest extends TestCase
{
    public function testRetornaTodasInstituicoes()
    {
        $response = $this->json('GET', 'api/instituicoes');
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => 1,
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
