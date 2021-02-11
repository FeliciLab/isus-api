<?php

namespace Tests\Feature\QualiQuiz;

use App\Domains\QualiQuiz\Models\AlternativaQuestao;
use App\Domains\QualiQuiz\Models\Quiz;
use App\Domains\QualiQuiz\Models\QuizQuestao;
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
class RespostasQuizTest extends TestCase
{
    use RefreshDatabase;

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
        $this->seed();
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
            $this->authorization['resposta']
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
        $this->withHeaders($this->authorization['resposta'])
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
        $this->withHeaders($this->authorization['resposta'])
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
        $this->withHeaders($this->authorization['resposta'])
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
        $this->seed();
        $this->withHeaders($this->authorization['resposta'])
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
        $this->seed();
        $quiz = Quiz::where('cod_quiz', $this->codQuiz)
            ->select('id')->first();
        $questoes = QuizQuestao::where('quiz_id', $quiz->id)
            ->limit(2)
            ->select('questao_id')
            ->get()
            ->toArray();

        $alternativas = AlternativaQuestao::whereIn(
            'questao_id',
            array_map(
                function ($item) {
                    return $item['questao_id'];
                },
                $questoes
            )
        )
            ->select('id', 'questao_id')
            ->get()
            ->keyBy('questao_id')
            ->toArray();

        $this->withHeaders($this->authorization['resposta'])
            ->json(
                'POST',
                '/api/qualiquiz/respostas',
                [
                    "respostas" => array_map(
                        function ($item) use ($quiz, $alternativas) {
                            return [
                                "quizId" => $quiz->id,
                                "questaoId" => $item['questao_id'],
                                "alternativaId" => $alternativas[$item['questao_id']]['id'],
                                "tempo" => 60
                            ];
                        },
                        $questoes
                    )
                ]
            )
            ->assertOk();
    }
}
