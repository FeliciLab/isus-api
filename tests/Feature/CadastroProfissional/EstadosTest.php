<?php

namespace Tests\Feature\CadastroProfissional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EstadosTest extends TestCase
{
    public function testRetornaTodosOsEstados()
    {
        $response = $this->json('GET', 'api/estados');
        $response->assertOk();
        $response->assertJsonCount(27);
        $response->assertJsonFragment([
            "id" => 1,
            "nome" => "Acre",
            "uf" => "AC"
        ]);
    }
}
