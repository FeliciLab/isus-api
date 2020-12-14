<?php

namespace Tests\Feature\QualiQuiz;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Classe de teste da funcionalidade de salvar resposta
 *
 * @category QualiQuiz
 * @package  Tests\Feature\QualiQuiz
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api/issues/131
 */
class RepostasTest extends TestCase
{
    use RefreshDatabase;

    private $_authorization = [
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.'
            . 'eyJlbWFpbCI6ImRldkBkZXYuZGV2Iiwibm9tZSI6IkRldiBkZXYiLCJjcGYiOiIx'
            . 'MjMuMTIzLjEyMy02OSJ9.CkWK7LixybXxO7vCatModnOD_X8C0uCTJU89KPex-Vo'
    ];

    private $_jsonForm = [
        "respostas" => [
            [
                "quizId" => 1,
                "questaoId" => 6,
                "alternativaId" => 16,
                "tempo" => 60
            ],
            [
                "quizId" => 1,
                "questaoId" => 3,
                "alternativaId" => 8,
                "tempo" => 90
            ]
        ]
    ];

    /**
     * Função callback que remove um item do array de respostas
     *
     * @param $campo string
     *
     * @return function
     */
    private function _callbackMapRemoveField($campo)
    {
        return function ($item) use ($campo) {
            unset($item[$campo]);
            return $item;
        };
    }

    /**
     * Remove um campo de respostas para as funções de testes
     *
     * @param $campo string Campo a ser removido
     *
     * @return array
     */
    private function _removeCampo($campo)
    {
        return array_map(
            $this->_callbackMapRemoveField($campo),
            $this->_jsonForm['respostas']
        );
    }

    /**
     * Verifica se a rota existe, ela deve retornar qualquer coisa menos 404
     *
     * @return void
     */
    public function testRotaExiste()
    {
        $response = $this->post('/api/qualiquiz/respostas');
        $this->assertNotEquals(404, $response->getStatusCode());
    }

    /**
     * Função para verificar se está definido somente post para a rota
     *
     * @return void
     */
    public function testAceitarSomentePost()
    {
        $this->get('/api/qualiquiz/respostas')->assertStatus(405);
        $this->put('/api/qualiquiz/respostas')->assertStatus(405);
        $this->patch('/api/qualiquiz/respostas')->assertStatus(405);
        $this->delete('/api/qualiquiz/respostas')->assertStatus(405);
    }

    /**
     * Verifica se a usuária da api enviou o token
     *
     * @return void
     */
    public function testPostSemTokenAutenticacao()
    {
        $response = $this->post('/api/qualiquiz/respostas');
        $response->assertUnauthorized();
    }

    /**
     * Valida se o token enviado é joiado
     *
     * @return void
     */
    public function testTokenInvalido()
    {
        $response = $this->withHeaders(
            [
                'Authorization' => 'Bearer 8192hfdau.dfuihas0123.sadhuiasdh9123'
            ]
        )->post('/api/qualiquiz/respostas');

        $response->assertStatus(400)
            ->assertJson(['messagem' => 'Token inválido']);
    }

    /**
     * Testa validação do campo resposta
     *
     * @return void
     */
    public function testListRespostaNaoEnviada()
    {
        $this->withHeaders(
            $this->_authorization
        )->postJson(
            '/api/qualiquiz/respostas',
            [ $this->_jsonForm['respostas'][0] ]
        )->assertStatus(400)
            ->assertJson(
                [
                    'messagem' => [
                        'respostas' => [
                            'O campo respostas é obrigatório.'
                        ]
                    ]
                ]
            );
    }

    /**
     * Testa validação do campo quizId na lista de respostas
     *
     * @return void
     */
    public function testValidacaoDoCampoQuizId()
    {
        $this->withHeaders($this->_authorization)
            ->postJson(
                '/api/qualiquiz/respostas',
                [
                    'respostas' => $this->_removeCampo('quizId')
                ]
            )
            ->assertStatus(400)
            ->assertJson(
                [
                    'messagem' => [
                        "respostas.0.quizId" => [
                            "O campo respostas.0.quizId é obrigatório."
                        ],
                        "respostas.1.quizId" => [
                            "O campo respostas.1.quizId é obrigatório."
                        ]
                    ]
                ]
            );
    }

    /**
     * Testa validação do campo quizId na lista de respostas
     *
     * @return void
     */
    public function testValidacaoDoCampoQuestaoId()
    {
        $this->withHeaders($this->_authorization)
            ->postJson(
                '/api/qualiquiz/respostas',
                [
                    'respostas' => $this->_removeCampo('questaoId')
                ]
            )
            ->assertStatus(400)
            ->assertJson(
                [
                    'messagem' => [
                        "respostas.0.questaoId" => [
                            "O campo respostas.0.questaoId é obrigatório."
                        ],
                        "respostas.1.questaoId" => [
                            "O campo respostas.1.questaoId é obrigatório."
                        ]
                    ]
                ]
            );
    }

    /**
     * Testa validação do campo alternativaId na lista de respostas
     *
     * @return void
     */
    public function testValidacaoDoCampoAlternativaId()
    {
        $this->withHeaders($this->_authorization)
            ->postJson(
                '/api/qualiquiz/respostas',
                [
                    'respostas' => $this->_removeCampo('alternativaId')
                ]
            )
            ->assertStatus(400)
            ->assertJson(
                [
                    'messagem' => [
                        "respostas.0.alternativaId" => [
                            "O campo respostas.0.alternativaId é obrigatório."
                        ],
                        "respostas.1.alternativaId" => [
                            "O campo respostas.1.alternativaId é obrigatório."
                        ]
                    ]
                ]
            );
    }

    /**
     * Testa validação do campo tempo na lista de respostas
     *
     * @return void
     */
    public function testValidacaoDoCampoTempo()
    {
        $this->withHeaders($this->_authorization)
            ->postJson(
                '/api/qualiquiz/respostas',
                [
                    'respostas' => $this->_removeCampo('tempo')
                ]
            )
            ->assertStatus(400)
            ->assertJson(
                [
                    'messagem' => [
                        "respostas.0.tempo" => [
                            "O campo respostas.0.tempo é obrigatório."
                        ],
                        "respostas.1.tempo" => [
                            "O campo respostas.1.tempo é obrigatório."
                        ]
                    ]
                ]
            );
    }

    /**
     * Salvar as respostas
     *
     * @return void
     */
    public function testSalvaRespostas()
    {
        $this->assertDatabaseCount('qquiz_respostas', 1);
        // $this->withHeaders($this->_authorization)
        //     ->postJson('/api/qualiquiz/respostas', $this->_jsonForm)
        //     ->assertStatus(200)
        //     ->assertJson(['messagem' => 'Salvo com sucesso']);
    }
}
