<?php

namespace Tests\Feature;

use App\Model\CategoriaProfissional;
use App\Model\Estado;
use App\Model\UnidadeServico;
use App\Model\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        $this->seed();

        $fakerBrasil = new Generator();
        $fakerBrasil->addProvider(new \Faker\Provider\pt_BR\Person($fakerBrasil));

        $faker = Factory::create();
        $estado = Estado::find($faker->numberBetween(1, 27));
        $municipio = $estado->municipios()->first();

        $unidadesDeServico = UnidadeServico::whereNotNull('pai');
        $unidades = $unidadesDeServico->first();

        $categoriasProfissional = CategoriaProfissional::all();
        $categoriaProfissional = $categoriasProfissional->first();
        return [
            'email' => $faker->email,
            'nomeCompleto' => $faker->name(),
            'senha' => '12345678',
            'repetirsenha' => '12345678',
            'telefone' => '123456789',
            'cpf' => $fakerBrasil->cpf(false),
            'rg' => $fakerBrasil->rg(false),
            'estadoId' => $estado->id,
            'estado' => $estado->nome,
            'cidadeId' => $municipio->id,
            'cidade' => $municipio->nome,
            'termos' => 'true',
            'categoriaProfissional' => json_encode($categoriaProfissional),
            'titulacaoAcademica' => '[{"id":1,"nome":"Titulação 1"},{"id":2,"nome":"Titulação 2"}]',
            'tipoContratacao' => '[{"id":1,"nome":"Estatutário"},{"id":2,"nome":"Cooperado"}]',
            'instituicao' => '[{"id":1,"nome":"ESP 1"},{"id":2,"nome":"HGF 2"}]',
            'unidadeServico' => json_encode([$unidades])
        ];
    }

    public function testCadastroProfissionalSemDados()
    {
        $response = $this->json('POST', 'api/user', [
        ]);
        $response->assertOk();
        $response->assertJsonFragment([
            'sucesso' => false
        ]);
    }

    public function testCadastroProfissional()
    {
        $users = User::all();
        foreach ($users as $user) {
            foreach ($user->unidadesServicos as $userUnidadeServico) {
                $userUnidadeServico->delete();
            }
            $user->delete();
        }

        $user = $this->getUser();

        $response = $this->json('POST', 'api/user', $user);
        $response->assertOk();
        $response->assertJsonFragment([
            'sucesso' => true,
            'mensagem' => 'Usuário cadastrado com sucesso'
        ]);
    }

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

        if (!is_null($access_token)) {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
            ])->json('GET', "api/perfil");
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
