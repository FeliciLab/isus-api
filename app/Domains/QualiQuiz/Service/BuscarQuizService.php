<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Service;

use App\Domains\QualiQuiz\Repository\AlternativaQuestaoRepository;
use App\Domains\QualiQuiz\Repository\QuestaoRepository;
use App\Domains\QualiQuiz\Repository\QuizQuestaoRepository;
use App\Domains\QualiQuiz\Repository\QuizRepository;
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
    }

    /**
     * Mapear as altertivas para as questões e formatar o array.
     *
     * @param $alternativas
     * @param $questao
     *
     * @return array
     */
    public function mapearFormatarAlternativasQuestoes($alternativas, $questao)
    {
        return $alternativas->filter(
            function ($alternativa) use ($questao) {
                return $alternativa->questao_id === $questao->id;
            }
        )->map(
            function ($item) {
                return [
                    'id' => $item->id,
                    'alternativa' => $item->alternativa,
                    'ordem' => $item->ordem,
                ];
            }
        );
    }

    /**
     * Mapeia as questões para o formato desejado no front.
     *
     * @param $questoes array
     * @param $quizQuestoes QuizQuestoes
     * @param $alternativas array
     *
     * @return mix
     */
    public function mapearFormatarQuestoes($questoes, $quizQuestoes, $alternativas)
    {
        return $questoes->map(
            function ($questao) use ($quizQuestoes, $alternativas) {
                return [
                    'id' => $questao->id,
                    'ordem' => $quizQuestoes->get($questao->id)->ordem,
                    'questao' => $questao->questao,
                    'alternativas' => $this->mapearFormatarAlternativasQuestoes(
                        $alternativas,
                        $questao
                    ),
                ];
            }
        );
    }

    /**
     * Efetua a consulta na base de dados.
     *
     * @param $codQuiz Int número do id do quiz
     *
     * @return Collection
     */
    public function buscarQuizCompleto(int $codQuiz): Collection
    {
        $quiz = $this->quizRepository->buscarQuiz($codQuiz);
        if (!$quiz) {
            return false;
        }

        $quizQuestoes = $this->quizQuestaoRepository
            ->buscarQuizQuestaoPorQuizId($quiz->id);

        $questoes = $this->questaoRepository->buscarQuestao(
            $quizQuestoes->map(
                function ($item) {
                    return $item->questao_id;
                }
            )
        );

        $alternativas = $this->alternativaQuestaoRepository
            ->buscarAlternativasPelosIdsQuestoes(
                $questoes->map(
                    function ($item) {
                        return $item->id;
                    }
                )
            );

        return collect(
            [
                'id' => $quiz->id,
                'quiz' => $quiz->nome,
                'questoes' => $this->mapearFormatarQuestoes(
                    $questoes,
                    $quizQuestoes,
                    $alternativas
                ),
            ]
        );
    }
}
