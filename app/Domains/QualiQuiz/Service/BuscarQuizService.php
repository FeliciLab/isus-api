<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Service;

use App\Domains\QualiQuiz\Models\Questao;
use App\Domains\QualiQuiz\Repository\AlternativaQuestaoRepository;
use App\Domains\QualiQuiz\Repository\QuestaoRepository;
use App\Domains\QualiQuiz\Repository\QuizQuestaoRepository;
use App\Domains\QualiQuiz\Repository\QuizRepository;
use App\Domains\QualiQuiz\Repository\RespostaRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Serviço para buscar o quiz na base.
 *
 * @category QualiQuiz
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api
 */
class BuscarQuizService
{
    public $quizRepository;
    public $quizQuestaoRepository;
    public $questaoRepository;
    public $alternativaQuestaoRepository;

    /**
     * Init.
     */
    public function __construct()
    {
        $this->quizRepository = new QuizRepository();
        $this->quizQuestaoRepository = new QuizQuestaoRepository();
        $this->questaoRepository = new QuestaoRepository();
        $this->alternativaQuestaoRepository = new AlternativaQuestaoRepository();
        $this->respostaRepository = new RespostaRepository();
    }

    /**
     * Mapear as altertivas para as questões e formatar o array.
     *
     * @param Collection $alternativas Lista de alternativas
     * @param Questao    $questao      Questão correspondente a alternativa
     *
     * @return array
     */
    public function mapearFormatarAlternativasQuestoes(array $alternativas)
    {
        return array_map(function ($item) {
            return [
                'id' => $item->id,
                'alternativa' => $item->alternativa,
                'ordem' => $item->ordem,
            ];
        }, $alternativas);
    }

    /**
     * Mapeia as questões para o formato desejado no front.
     *
     * @param Collection $questoes     Lista de questoes
     * @param Collection $quizQuestoes Lista de questoes do quiz
     * @param Collection $alternativas Lista de alternativas
     *
     * @return mix
     */
    public function mapearFormatarQuestoes(
        Collection $questoes,
        Collection $quizQuestoes,
        array $alternativas
    ) {
        return $questoes->map(
            function ($questao) use ($quizQuestoes, $alternativas) {
                return [
                    'id' => $questao->id,
                    'ordem' => $quizQuestoes->get($questao->id)->ordem,
                    'questao' => $questao->questao,
                    'alternativas' => $this->mapearFormatarAlternativasQuestoes(
                        $alternativas[$questao->id]
                    ),
                ];
            }
        );
    }

    /**
     * Efetua a consulta na base de dados.
     *
     * @param int $codQuiz número do id do quiz
     *
     * @return Collection
     */
    public function buscarQuizCompleto(int $codQuiz): Collection
    {
        $quiz = $this->quizRepository->buscarQuiz($codQuiz);
        if (!$quiz) {
            return collect(
                [
                    'mensagem' => 'Quiz não encontrado',
                    'status' => 404,
                    'ok' => false,
                ]
            );
        }

        $quizQuestoes = $this->quizQuestaoRepository
            ->buscarQuizQuestaoPorQuizId($quiz->id);

        $questoes = $this->questaoRepository->buscarQuestao(
            $quizQuestoes->map(
                function ($item) {
                    return $item->questao_id;
                }
            )->toArray()
        );

        $alternativas = $this->alternativaQuestaoRepository
            ->buscarAlternativasPelosIdsQuestoes(
                $questoes->map(
                    function ($item) {
                        return $item->id;
                    }
                )->toArray()
            )->reduce(function ($acumulado, $atual) {
                if (!Arr::get($acumulado, $atual->quetao_id, false)) {
                    $acumulado[$atual->questao_id] = [];
                }

                $acumulado[$atual->questao_id][] = $atual;

                return $acumulado;
            }, []);

        return collect(
            [
                'id' => $quiz->id,
                'quiz' => $quiz->nome,
                'tempo_limite' => $quiz->tempo_limite,
                'descricao' => $quiz->descricao,
                'questoes' => $this->mapearFormatarQuestoes(
                    $questoes,
                    $quizQuestoes,
                    $alternativas
                ),
            ]
        );
    }

    /**
     * Verifica se a usuária solicitante do quiz já o efetuou.
     *
     * @param $quizId       int
     * @param $autenticacao Collection
     *
     * @return bool
     */
    public function verificarSeJaRespondeu(
        int $quizId,
        Collection $autenticacao
    ): bool {
        return $this->respostaRepository->verificaSeJaRespondeu($quizId, $autenticacao->get('email'));
    }

    /**
     * Busca o quiz pelo cod_quiz.
     *
     * @param $codQuiz string
     *
     * @return Quiz|null
     */
    public function buscarQuizPeloCod(string $codQuiz)
    {
        return $this->quizRepository->buscarQuizPorIdOuCodQuiz($codQuiz);
    }

    public function buscarIdQuizAtivo(): int
    {
        $quiz = $this->quizRepository->buscarQuizAtivo();

        return $quiz->id;
    }
}
