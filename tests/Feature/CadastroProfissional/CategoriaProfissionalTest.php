<?php

namespace Tests\Feature\CadastroProfissional;

use App\Model\CategoriaProfissional;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaProfissionalTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function testRetornaTodasCategoriaProfissionais()
    {
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

    public function testRetornaTodasEspecialidadesPelaCategoriaMedicina()
    {
        $categoriaMedicina = CategoriaProfissional::CATEGORIA_PROFISSIONAL_MEDICINA;

        $response = $this->json('GET', "api/categorias-profissionais/{$categoriaMedicina}/especialidades");

        $response->assertOk();
        $response->assertJsonCount(56);
        $response->assertJsonStructure([
            [
                'id',
                'categoriaprofissional_id',
                'nome'
            ]
        ]);
    }
}
