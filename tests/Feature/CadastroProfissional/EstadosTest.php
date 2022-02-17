<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group cadastro_profissional
 */
class EstadosTest extends TestCase
{
    use RefreshDatabase;

    public function testRetornaTodosOsEstados()
    {
        $this->seed();

        $response = $this->json('GET', 'api/estados');
        $response->assertOk();
        $response->assertJsonCount(27);
        $response->assertJsonFragment([
            'id' => 1,
            'nome' => 'Acre',
            'uf' => 'AC',
        ]);
    }
}
