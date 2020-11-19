<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Repository;

use App\Domains\QualiQuiz\Models\QuizQuestao;
use Illuminate\Support\Collection;

/**
 * Conjunto de funções para consulta na tabela quiz_questoes.
 *
 * @category QualiQuiz
 *
 * @author   Chicão Thiago <fthiagogv@gmail.com>
 * @license  GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link     https://github.com/EscolaDeSaudePublica/isus-api
 */
class QuizQuestaoRepository
{
    /**
     * Busca a referência da questão pelo id do quiz.
     *
     * @param $idQuiz int
     *
     * @return Collection
     */
    public function buscarQuizQuestaoPorQuizId(int $idQuiz)
    {
        return (new QuizQuestao())
            ->select('id', 'ordem', 'questao_id')
            ->where('quiz_id', $idQuiz)
            ->get()
            ->keyBy('questao_id');
    }
}
