<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Repository;

use App\Domains\QualiQuiz\Models\Quiz;

/**
 * Conjunto de consultas para a tabela Quiz.
 *
 * @category QualiQuiz
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api
 */
class QuizRepository
{
    /**
     * Busca na base o quiz pelo id.
     *
     * @param int $codQuiz ID do Quiz
     *
     * @return Quiz|null
     */
    public function buscarQuiz(int $codQuiz)
    {
        return (new Quiz())
            ->select('id', 'nome')
            ->where('id', $codQuiz)
            ->first();
    }
}
