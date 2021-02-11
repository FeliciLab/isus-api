<?php

namespace Tests\Feature\QualiQuiz;

use App\Domains\QualiQuiz\Models\AlternativaQuestao;
use App\Domains\QualiQuiz\Models\Questao;
use App\Domains\QualiQuiz\Models\Quiz;
use App\Domains\QualiQuiz\Models\QuizQuestao;
use App\Domains\QualiQuiz\Models\Resposta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


/**
 * Teste da rota de buscar o quiz
 *
 * @category Tests
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api/
 */
class BuscarQuizTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Insere respostas para fins de teste
     *
     * @return void
     */
    private function _inserirResposta()
    {
        $quiz = Quiz::where('cod_quiz', $this->codQuiz)->select('id')->first();
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

    /**
     * Testa o retorno de status não autorizado ao não enviar um Token
     *
     * @return void
     */
    public function testTokenNaoEnviado()
    {
        $this->seed();
        $this->get("/api/qualiquiz/quiz/{$this->codQuiz}")
            ->assertUnauthorized();
    }

    /**
     * Testa se o retorno para tokens invalidos
     *
     * @return void
     */
    public function testTokenInvalido()
    {
        $this->seed();

        $this->withHeader('Authorization', 'Bearer euiadhadfaf;sdafjasdfasdf')
            ->get("/api/qualiquiz/quiz/{$this->codQuiz}")
            ->assertStatus(400);
    }

    /**
     * Testa o retorno de erro para quando não se envia o id do quiz
     *
     * @return void
     */
    public function testNaoEnvioDoCodigoQuiz()
    {
        $this->seed();

        $this->get('/api/qualiquiz/quiz')
            ->assertNotFound();
    }

    /**
     * Testa se a pes. usuária realizou o quiz e retorna a pontuação
     *
     * @return void
     */
    public function testRetornarPontuacaoNaBusca()
    {
        $this->seed();
        config(['app.qualiquiz.bloquear_refazer' => true]);
        $this->_inserirResposta();
        $this->withHeaders($this->authorization['resposta'])
            ->get("/api/qualiquiz/quiz/{$this->codQuiz}")
            ->assertOk()
            ->assertJsonStructure(['resultado', 'comentarioQuestoes']);
    }

    /**
     * Testa se a pes. usuária não realizou o quiz e retorna o quiz
     *
     * @return void
     */
    public function testRetornaQuiz()
    {
        $this->seed();

        $this->withHeaders($this->authorization['busca'])
            ->get("/api/qualiquiz/quiz/{$this->codQuiz}")
            ->assertOk()
            ->assertJsonStructure(['id', 'quiz', 'tempo_limite', 'questoes']);
    }
}
