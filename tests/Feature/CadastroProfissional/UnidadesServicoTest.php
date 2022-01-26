<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group cadastro_profissional
 */
class UnidadesServicoTest extends TestCase
{
    use RefreshDatabase;

    public function testRetornaTodasSubUnidadesServico()
    {
        $this->seed();

        $response = $this->json('GET', 'api/unidades-servico');
        $response->assertOk();
        $response->assertJsonFragment([
            'pai' => 1,
            'nome' => 'Pronto-socorro',

        ]);
        $response->assertJsonStructure([
            [
                'id',
                'pai',
                'nome',
            ],
        ]);
    }
}
