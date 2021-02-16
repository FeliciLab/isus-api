<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testConsultaPerfil()
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

        $this->assertNotNull($access_token);

        if (is_null($access_token)) {
            return false;
        }

        $response = $this->withHeaders(
            [
                'Authorization' => 'Bearer ' . $access_token,
            ]
        )
            ->json('GET', "api/perfil");

        $response->assertOk();
        $response->assertJsonStructure([
            'sucesso',
            'data' => [
                'id',
                'id_keycloak',
                'name',
                'email',
                'cpf',
                'telefone',
                'created_at',
                'updated_at',
                'municipio' => [
                    'id',
                    'estado_id',
                    'nome'
                ],
                'estado' => [
                    'id',
                    'nome',
                    'uf'
                ],
                'profissional' => [
                    'categoria_profissional',
                    'tipos_contratacoes',
                    'titulacoes_academica',
                    'unidades_servicos',
                    'especialidades'
                ]
            ]
        ]);
    }

    public function testConsultaPerfilTokenInvalido()
    {
        $this->seed();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer xyz',
        ])->json('GET', "api/perfil");
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJsonFragment([
            'sucesso' => false,
            'erros' => 'Token não autorizado'
        ]);
    }

    public function testRefreshToken()
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
        $refresh_token = $data->mensagem->refresh_token;

        if (!is_null($refresh_token)) {
            $response = $this->json('POST', "api/refresh-token", ['refresh_token' => $refresh_token]);
            $response->assertOk();
            $response->assertJsonStructure([
                'sucesso',
                'mensagem' => [
                    'access_token',
                    'expires_in',
                    'refresh_expires_in',
                    'refresh_token',
                    'token_type',
                    'not-before-policy',
                    'session_state',
                    'scope'
                ]
            ]);
        }
    }


    public function testExcluirUsuario()
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
            ])->json("DELETE", "api/user");
            $response->assertOk();
            $response->assertJsonStructure([
                'sucesso',
                'mensagem'
            ]);
            $response->assertJson([
                'sucesso' => true,
            ]);
        }
    }
}
