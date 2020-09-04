<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TiposContratacoesTest extends TestCase
{
    use RefreshDatabase;

    public function testRetornaTodosTiposDeContratacoes()
    {
        $this->seed();

        $response = $this->json('GET', 'api/tipos-contratacoes');
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => 1,
            'nome' => 'Estatutário'
        ]);
        $response->assertJsonStructure([
            [
                'id',
                'nome'
            ]
        ]);
    }
}
