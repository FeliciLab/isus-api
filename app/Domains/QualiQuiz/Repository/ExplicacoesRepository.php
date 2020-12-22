<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Repository;

use Illuminate\Support\Collection;
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
class ExplicacoesRepository
{
    /**
     * Consulta na base de dados as explicações de um determinado Quiz.
     *
     * @param $idQuiz int
     *
     * @return Collection
     */
    public function buscarExplicacoesDoQuiz(int $idQuiz): Collection
    {
        return collect(
            DB::table('qquiz_explicacoes as qe')
                ->select(
                    'qe.descricao as descricao',
                    'qqq.ordem as questao'
                )
                ->join(
                    'qquiz_quiz_questoes as qqq',
                    function ($join) use ($idQuiz) {
                        $join->on('qe.questao_id', '=', 'qqq.questao_id')
                            ->where('qqq.quiz_id', '=', $idQuiz);
                    }
                )
                ->get()
        );
    }
}
