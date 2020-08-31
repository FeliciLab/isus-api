<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TitulacoesAcademicaTest extends TestCase
{
    public function testRetornaTodasTitulacoesAcademica()
    {
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
