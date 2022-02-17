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

    public function testLoginSemEmailEPassword()
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
                        'email' => [
                            'O campo email é obrigatório.',
                        ],
                        'senha' => [
                            'O campo senha é obrigatório.',
                        ],
                    ],
                ]
            );
    }

    public function testLoginSemEmail()
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
                        'email' => [
                            'O campo email é obrigatório.',
                        ],
                    ],
                ]
            );
    }

    public function testLoginEmailInvalido()
    {
        $this->json(
            'POST',
            'api/auth',
            [
                'email' => 'email-invalido',
                'senha' => 'joinado',
            ]
        )
            ->assertStatus(400)
            ->assertJson(
                [
                    'erros' => [
                        'email' => [
                            'O campo email deve ser um endereço de e-mail válido.',
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
                'email' => 'email@email.com',
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
                'email' => 'user@mail.com',
                'senha' => '987654',
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
            ['email' => $usuario['email'], 'senha' => $usuario['senha']]
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
