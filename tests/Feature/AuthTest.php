<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testLoginSemUsernameEPassword()
    {
        $this->json(
            'POST',
            'api/auth',
            []
        )
            ->assertStatus(400)
            ->assertJson(
                [
                    'erros' => [
                        'username' => [
                            'O campo username é obrigatório.',
                        ],
                        'senha' => [
                            'O campo senha é obrigatório.',
                        ],
                    ],
                ]
            );
    }

    public function testLoginSemUsername()
    {
        $this->json(
            'POST',
            'api/auth',
            [
                'senha' => '1234556678',
            ]
        )
            ->assertStatus(400)
            ->assertJson(
                [
                    'erros' => [
                        'username' => [
                            'O campo username é obrigatório.',
                        ],
                    ],
                ]
            );
    }

    public function testLoginUsernameInvalido()
    {
        $this->json(
            'POST',
            'api/auth',
            [
                'username' => '',
                'senha' => 'joinado',
            ]
        )
            ->assertStatus(400)
            ->assertJson(
                [
                    'erros' => [
                        'username' => [
                            'O campo username é obrigatório.',
                        ],
                    ],
                ]
            );
    }

    public function testLoginSemSenha()
    {
        $this->json(
            'POST',
            'api/auth',
            [
                'username' => 'email@email.com',
            ]
        )
            ->assertStatus(400)
            ->assertJson(
                [
                    'erros' => [
                        'senha' => [
                            'O campo senha é obrigatório.',
                        ],
                    ],
                ]
            );
    }

    public function testCredenciaisInvalidas()
    {
        $this->json(
            'POST',
            'api/auth',
            [
                'username' => 'username@mail.com',
                'senha' => '98765432',
            ]
        )
            ->assertUnauthorized()
            ->assertJson(
                [
                    'erros' => 'Usuário ou senha inválidos',
                ]
            );
    }

    public function testLoginSucesso()
    {
        $usuario = $this->registrarUsuario(false);

        $this->assertNotNull($usuario);

        $this->json(
            'POST',
            'api/auth',
            ['username' => $usuario['username'], 'senha' => $usuario['senha']]
        )
            ->assertOk()
            ->assertJsonStructure(
                [
                    'mensagem' => [
                        'access_token',
                    ],
                ]
            );
    }
}
