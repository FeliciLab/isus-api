<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Repository;

use App\Domains\QualiQuiz\Models\Quiz;
use Illuminate\Support\Facades\DB;

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

    public function buscarTituloDataNumeroQuestoesQuizAtivos()
    {
        $titleDateNumberQuestions = DB::table('qquiz_quiz as qq')
            ->selectRaw(
                'qq.id as id,
                qq.cod_quiz as cod_quiz,
                qq.nome as titulo,
                qq.created_at as data_criacao,
                COUNT(qqq.id) as total_questoes'
            )
            ->join('qquiz_quiz_questoes as qqq', 'qq.id', '=', 'qqq.quiz_id')
            ->groupBy('qq.nome', 'qq.created_at', 'qq.id', 'qq.cod_quiz')
            ->where('qq.ativo', true)
            ->get();
        return $titleDateNumberQuestions;
    }

}
