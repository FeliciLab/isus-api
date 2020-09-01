<?php

namespace Tests\Feature;

use App\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    private function getUser()
    {
        return [
            'email' => 'teste@gmail.com',
            'nomeCompleto' => 'Victor Mag',
            'senha' => '12345678',
            'repetirsenha' => '12345678',
            'telefone' => '9999999999',
            'cpf' => '12345678900',
            'rg' => '12345678900',
            'estadoId' => '6',
            'estado' => 'Ceará',
            'cidadeId' => '1347',
            'cidade' => 'Fortaleza',
            'termos' => 'true',
            'categoriaProfissional' => '{"id":1,"nome":"Categoria 1"}',
            'titulacaoAcademica' => '[{"id":1,"nome":"Titulação 1"},{"id":2,"nome":"Titulação 2"}]',
            'tipoContratacao' => '[{"id":1,"nome":"Estatutário"},{"id":2,"nome":"Cooperado"}]',
            'instituicao' => '[{"id":1,"nome":"ESP 1"},{"id":2,"nome":"HGF 2"}]',
            'unidadeServico' => '[{"id":5,"nome":"Pronto-socorro"},{"id":6,"nome":"Ambulatório"}]'
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
}
