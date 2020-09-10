<?php

namespace Tests\Feature\Wordpress;

use App\Model\Estado;
use App\Model\UnidadeServico;
use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\CategoriaProjeto;
use App\Model\Wordpress\Projeto;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
            'email' => $usuario['email'],
            'senha' => $usuario['senha']
        ];

        $response = $this->json('POST', 'api/auth', $user);
        $data = $response->getData();
        $access_token = $data->mensagem->access_token;

        if (!is_null($access_token)) {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
            ])->json('GET', "api/projetos-por-profissional");
            $response->assertOk();
            $response->assertJsonFragment([
                'sucesso' => true,
                'projetosDoProfissional' => []
            ]);
        }
    }

    public function testProjetosPorProfissionalComUnidadeDeServico()
    {
        $this->seed();

        $comUnidadesDeServico = true;
        $usuario = $this->registrarUsuario($comUnidadesDeServico);

        $user = [
            'email' => $usuario['email'],
            'senha' => $usuario['senha']
        ];

        $response = $this->json('POST', 'api/auth', $user);
        $data = $response->getData();
        $access_token = $data->mensagem->access_token;

        if (!is_null($access_token)) {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
            ])->json('GET', "api/projetos-por-profissional");
            $response->assertOk();
            $response->assertJsonFragment([
                'sucesso' => true,
                'projetosDoProfissional' => []
            ]);
        }
    }
}
