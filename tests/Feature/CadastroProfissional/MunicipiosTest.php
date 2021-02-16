<?php

namespace Tests\Feature\CadastroProfissional;

use App\Model\Estado;
use App\Model\Municipio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MunicipiosTest extends TestCase
{
    use RefreshDatabase;

    public function testRetornaMunicipiosDeUmEstado()
    {
        $this->seed();

        $estado = Estado::find(1);

        $response = $this->json('GET', "api/estados/{$estado->id}/municipios");
        $response->assertOk();
        $response->assertJsonStructure([
            [
                'id',
                'estado_id',
                'nome'
            ]
        ]);
        $response->assertJsonFragment([
            [
                'id' => 1,
                'estado_id' => 1,
                'nome' => 'Acrelândia',
            ]
        ]);
    }
}
