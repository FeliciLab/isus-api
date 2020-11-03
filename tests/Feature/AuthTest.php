<?php

namespace Tests\Feature;

use App\Model\CategoriaProfissional;
use App\Model\Estado;
use App\Model\UnidadeServico;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testLoginSemEmail()
    {
        $response = $this->json('POST', 'api/auth', []);
        $response->assertOk();
        $response->assertJsonPath('erros.email', ['O campo email é obrigatório.']);
    }

    public function testLoginSemSenha()
    {
        $response = $this->json('POST', 'api/auth', []);
        $response->assertOk();
        $response->assertJsonPath('erros.senha', ['O campo senha é obrigatório.']);
    }


    public function testFalhaLogin()
    {
        $response = $this->json('POST', 'api/auth', ['email' => 'user@mail.com', 'senha' => '987654']);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJsonFragment([
            'sucesso' => false,
            'erros' => 'Usuário ou senha inválidos'
        ]);
    }

    public function testLoginok()
    {
        $usuario = $this->registrarUsuario(false);

        $response = $this->json('POST', 'api/auth', ['email' => $usuario['email'], 'senha' => $usuario['senha']]);
        $response->assertOk();
        $response->assertJsonStructure([
            'mensagem' => [
                'access_token'
            ]
        ]);
    }
}
