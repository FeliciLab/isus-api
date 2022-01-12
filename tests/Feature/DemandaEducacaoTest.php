<?php

namespace Tests\Feature;

use Tests\TestCase;

class DemandaEducacaoTest extends TestCase
{
    public function testdemandaEducacaoComSucesso()
    {
        $response = $this->postJson('api/demanda-educacao', [
            'email' => 'victor.magalhaesp@gmail.com',
            'descricao' => 'descricao',
            'unidadeDeSaude' => 'unidadeDeSaude',
            'versaoAplicativo' => 1,
            'plataforma' => 'android',
        ]);
        $response->assertOk();
        $response->assertJsonFragment([
            'success' => true,
        ]);
    }
}
