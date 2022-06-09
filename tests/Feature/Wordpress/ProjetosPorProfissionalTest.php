<?php

namespace Tests\Feature\Wordpress;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group wordpress
 */
class ProjetosPorProfissionalTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testProjetosPorProfissionalSemUnidadeDeServico()
    {
        $this->seed();

        $comUnidadesDeServico = false;
        $usuario = $this->registrarUsuario($comUnidadesDeServico);

        $user = [
            'username' => $usuario['email'],
            'senha' => $usuario['senha'],
        ];

        $response = $this->json('POST', 'api/auth', $user);
        $data = $response->getData();
        $access_token = $data->mensagem->access_token;

        if (null !== $access_token) {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
            ])->json('GET', 'api/projetos-por-profissional');
            $response->assertOk();
            $response->assertJsonFragment([
                'sucesso' => true,
                'projetosDoProfissional' => [],
            ]);
        }
    }

    public function testProjetosPorProfissionalComUnidadeDeServico()
    {
        $this->seed();

        $comUnidadesDeServico = true;
        $usuario = $this->registrarUsuario($comUnidadesDeServico);

        $user = [
            'username' => $usuario['email'],
            'senha' => $usuario['senha'],
        ];

        $response = $this->json('POST', 'api/auth', $user);
        $data = $response->getData();
        $access_token = $data->mensagem->access_token;

        if (null !== $access_token) {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
            ])->json('GET', 'api/projetos-por-profissional');
            $response->assertOk();
            $response->assertJsonFragment([
                'sucesso' => true,
                'projetosDoProfissional' => [],
            ]);
        }
    }
}
