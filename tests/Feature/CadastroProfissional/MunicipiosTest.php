<?php

namespace Tests\Feature\CadastroProfissional;

use App\Model\Estado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group cadastro_profissional
 */
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
                'nome',
            ],
        ]);
        $response->assertJsonFragment([
            [
                'id' => 1,
                'estado_id' => 1,
                'nome' => 'Acrelândia',
            ],
        ]);
    }
}
