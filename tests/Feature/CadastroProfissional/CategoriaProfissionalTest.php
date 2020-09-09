<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaProfissionalTest extends TestCase
{
    use RefreshDatabase;

    public function testRetornaTodasCategoriaProfissionais()
    {
        $this->seed();

        $response = $this->json('GET', 'api/categorias-profissionais');
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => 1,
            'nome' => 'Medicina'
        ]);
        $response->assertJsonStructure([
            [
                'id',
                'nome'
            ]
        ]);
    }
}
