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
        $usuario = $this->getUser();

        $response = $this->json('POST', 'api/auth', ['email' => $usuario['email'], 'senha' => $usuario['senha']]);
        $response->assertOk();
        $response->assertJsonStructure([
            'mensagem' => [
                'access_token'
            ]
        ]);
    }


    public function getUser()
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

        $email = $faker->email;
        $senha = '12345678';

        $user = [
            'email' => $email,
            'nomeCompleto' => $faker->name(),
            'senha' => $senha,
            'repetirsenha' => '12345678',
            'telefone' => $faker->randomNumber(9),
            'cpf' => $fakerBrasil->cpf(false),
            'rg' => $fakerBrasil->rg(false),
            'estadoId' => $estado->id,
            'estado' => $estado->nome,
            'cidadeId' => $municipio->id,
            'cidade' => $municipio->nome,
            'termos' => 'true'
        ];

        $response = $this->json('POST', 'api/user', $user);

        return $user;
    }

}
