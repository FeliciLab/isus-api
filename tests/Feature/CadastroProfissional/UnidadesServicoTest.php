<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnidadesServicoTest extends TestCase
{
    public function testRetornaTodasUnidadesServico()
    {
        $response = $this->json('GET', 'api/unidades-servico');
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => 1,
            'nome' => 'Pronto-socorro'
        ]);
        $response->assertJsonStructure([
            [
                'id',
                'nome'
            ]
        ]);
    }
}
