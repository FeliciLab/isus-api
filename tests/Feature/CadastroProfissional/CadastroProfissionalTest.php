<?php

namespace Tests\Feature;

use App\Model\CategoriaProfissional;
use App\Model\Estado;
use App\Model\UnidadeServico;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group cadastro_profissional
 */
class CadastroProfissionalTest extends TestCase
{
    use RefreshDatabase;

    public function testErroCadastroProfissionalSemDados()
    {
        $this->json(
            'POST',
            'api/user',
            []
        )
            ->assertStatus(400)
            ->assertExactJson(
                [
                    'sucesso' => false,
                    'erros' => [
                        'email' => [
                            'O campo email é obrigatório.',
                        ],
                        'cpf' => [
                            'O campo cpf é obrigatório.',
                        ],
                        'nomeCompleto' => [
                            'O campo nome completo é obrigatório.',
                        ],
                        'senha' => [
                            'O campo senha é obrigatório.',
                        ],
                        'repetirsenha' => [
                            'O campo repetirsenha é obrigatório.',
                        ],
                        'telefone' => [
                            'O campo telefone é obrigatório.',
                        ],
                        'cidadeId' => [
                            'O campo cidade id é obrigatório.',
                        ],
                        'cidade' => [
                            'O campo cidade é obrigatório.',
                        ],
                        'termos' => [
                            'O campo termos deve ser aceito.',
                        ],
                    ],
                ]
            );
    }

    public function testCadastroSenhasDiferentes()
    {
        $this->json(
            'POST',
            'api/user',
            array_merge(
                $this->getUser(true),
                ['repetirsenha' => 'diferente']
            )
        )
            ->assertStatus(400)
            ->assertExactJson(
                [
                    'sucesso' => false,
                    'erros' => [
                        'senha' => [
                            'Os campos senha e repetirsenha devem corresponder.',
                        ],
                    ],
                ]
            );
    }

    public function testCadastroEmailInvalido()
    {
        $this->json(
            'POST',
            'api/user',
            array_merge(
                $this->getUser(true),
                ['email' => 'email-invalido']
            )
        )
            ->assertStatus(400)
            ->assertExactJson(
                [
                    'sucesso' => false,
                    'erros' => [
                        'email' => [
                            'O campo email deve ser um endereço de e-mail válido.',
                        ],
                    ],
                ]
            );
    }

    public function testCpfInvalido()
    {
        $this->json(
            'POST',
            'api/user',
            array_merge(
                $this->getUser(),
                ['cpf' => '12345678901']
            )
        )
            ->assertStatus(400)
            ->assertExactJson(
                [
                    'sucesso' => false,
                    'erros' => [
                        'cpf' => [
                            'CPF inválido',
                        ],
                    ],
                ]
            );
    }

    public function testCpfInvalidoMenorQueOnze()
    {
        $this->json(
            'POST',
            'api/user',
            array_merge(
                $this->getUser(),
                ['cpf' => '1234567890']
            )
        )
            ->assertStatus(400)
            ->assertExactJson(
                [
                    'sucesso' => false,
                    'erros' => [
                        'cpf' => [
                            'CPF inválido',
                            'O campo cpf deve ter pelo menos 11 caracteres.',
                        ],
                    ],
                ]
            );
    }

    public function testCpfInvalidoMaiorQueOnze()
    {
        $this->json(
            'POST',
            'api/user',
            array_merge(
                $this->getUser(),
                ['cpf' => '123456789012']
            )
        )
            ->assertStatus(400)
            ->assertExactJson(
                [
                    'sucesso' => false,
                    'erros' => [
                        'cpf' => [
                            'CPF inválido',
                            'O campo cpf não pode ser superior a 11 caracteres.',
                        ],
                    ],
                ]
            );
    }

    public function testTelefoneMenorQueNove()
    {
        $this->json(
            'POST',
            'api/user',
            array_merge(
                $this->getUser(),
                [
                    'telefone' => '12345678',
                ]
            )
        )
            ->assertStatus(400)
            ->assertExactJson(
                [
                    'sucesso' => false,
                    'erros' => [
                        'telefone' => [
                            'O campo telefone deve ter pelo menos 9 caracteres.',
                        ],
                    ],
                ]
            );
    }

    public function testTelefoneMaiorQueOnze()
    {
        $this->json(
            'POST',
            'api/user',
            array_merge(
                $this->getUser(),
                ['telefone' => '123456789012']
            )
        )
            ->assertStatus(400)
            ->assertExactJson(
                [
                    'sucesso' => false,
                    'erros' => [
                        'telefone' => [
                            'O campo telefone não pode ser superior a 11 caracteres.',
                        ],
                    ],
                ]
            );
    }

    public function testCadastroProfissionalCamposObrigatorios()
    {
        $user = $this->getUser(true);

        $this->json('POST', 'api/user', $user)
            ->assertOk()
            ->assertExactJson(
                [
                    'sucesso' => true,
                    'mensagem' => 'Usuário cadastrado com sucesso',
                ]
            );
    }

    public function testCadastroProfissionalTodosCampos()
    {
        $user = $this->getUser(false);

        $this->json('POST', 'api/user', $user)
            ->assertOk()
            ->assertExactJson(
                [
                    'sucesso' => true,
                    'mensagem' => 'Usuário cadastrado com sucesso',
                ]
            );
    }

    private function getUser($somenteObrigatorios = true)
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

        $usuarioCamposObrigatorios = [
            'email' => $faker->email,
            'nomeCompleto' => $faker->name(),
            'senha' => '12345678',
            'repetirsenha' => '12345678',
            'telefone' => '123456789',
            'cpf' => $fakerBrasil->cpf(false),
            'cidadeId' => $municipio->id,
            'cidade' => $municipio->nome,
            'termos' => 'true',
        ];

        if ($somenteObrigatorios) {
            return $usuarioCamposObrigatorios;
        }

        return array_merge(
            $usuarioCamposObrigatorios,
            [
                'rg' => $fakerBrasil->rg(false),
                'estadoId' => $estado->id,
                'estado' => $estado->nome,
                'categoriaProfissional' => json_encode($categoriaProfissional),
                'titulacaoAcademica' => '[{"id":1,"nome":"Titulação 1"},{"id":2,"nome":"Titulação 2"}]',
                'tipoContratacao' => '[{"id":1,"nome":"Estatutário"},{"id":2,"nome":"Cooperado"}]',
                'instituicao' => '[{"id":1,"nome":"ESP 1"},{"id":2,"nome":"HGF 2"}]',
                'unidadeServico' => json_encode([$unidades]),
            ]
        );
    }
}
