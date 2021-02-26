<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @group cadastro_profissional
 */
class TitulacoesAcademicaTest extends TestCase
{
    use RefreshDatabase;

    public function testRetornaTodasTitulacoesAcademica()
    {
        $this->seed();

        $response = $this->json('GET', 'api/titulacoes-academica');
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => 1,
            'nome' => 'Graduado'
        ]);
        $response->assertJsonStructure([
            [
                'id',
                'nome'
            ]
        ]);
    }
}
