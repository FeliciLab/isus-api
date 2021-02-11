<?php

namespace Tests;

use App\Model\Estado;
use App\Model\UnidadeServico;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $usuarioAutenticado;

    public string $codQuiz = 'ADFTS-SUS-P1';
    public $authorization = [
        'resposta' => [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.'
            . 'eyJlbWFpbCI6ImRldkBkZXYuZGV2Iiwibm9tZSI6IkRldiBkZXYiLCJjcGYiOiIx'
            . 'MjMuMTIzLjEyMy02OSJ9.CkWK7LixybXxO7vCatModnOD_X8C0uCTJU89KPex-Vo'
        ],
        'busca' => [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.'
            . 'eyJlbWFpbCI6ImRldkB0ZXN0ZS5kZXYiLCJub21lIjoiRGV2IGRldiIsImNwZiI6IjEifQ.'
            . 'cAmrqKcpRAzF5gJu_iPm1TRqZd7UnbQsSiAHWXhtLro'
        ],
    ];

    public function setUp(): void
    {
        parent::setUp();
    }

    public function registrarUsuario($comUnidadesDeServico)
    {
        $fakerBrasil = new Generator();
        $fakerBrasil->addProvider(new \Faker\Provider\pt_BR\Person($fakerBrasil));

        $faker = Factory::create();
        $estado = Estado::find($faker->numberBetween(1, 27));
        $municipio = $estado->municipios()->first();

        $unidadesDeServico = UnidadeServico::whereNotNull('pai');
        $unidades = $unidadesDeServico->first();

        $user = [
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
            'unidadeServico' => $comUnidadesDeServico ? json_encode([$unidades]) : null,
        ];

        $response = $this->json('POST', 'api/user', $user);
        $data = $response->getData();

        if ($data->sucesso) {
            return $user;
        }

        return null;
    }



}
