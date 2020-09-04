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

class AuthTest extends TestCase
{
    use RefreshDatabase;

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
        $response->assertOk();
        $response->assertJsonFragment([
            'sucesso' => false,
            'erros' => 'Não foi possível realizar o login do usuário'
        ]);
    }

    public function testLoginok()
    {
        $usuario = $this->registrarUsuario();

        $response = $this->json('POST', 'api/auth', ['email' => $usuario['email'], 'senha' => $usuario['senha']]);
        $response->assertOk();
        $response->assertJsonStructure([
            'mensagem' => [
                'access_token'
            ]
        ]);
    }
}
