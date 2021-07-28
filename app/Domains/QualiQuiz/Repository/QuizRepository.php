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
        return $this->buscarQuizPorIdOuCodQuiz((string) $codQuiz);
    }

    /**
     * Busca na base o quiz pelo cod_quiz.
     *
     * @param int $codQuiz ID do Quiz
     *
     * @return Quiz|null
     */
    public function buscarQuizPorIdOuCodQuiz(string $codQuiz)
    {
        return (new Quiz())
            ->where('id', $codQuiz)
            ->orWhere('cod_quiz', $codQuiz)
            ->first();
    }
    public function buscarQuizAtivo()
    {
        return (new Quiz())
            ->where('ativo', true)
            ->first();
    }
}
