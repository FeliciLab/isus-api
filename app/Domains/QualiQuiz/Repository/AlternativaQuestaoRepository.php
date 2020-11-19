<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Repository;

use App\Domains\QualiQuiz\Models\AlternativaQuestao;

/**
 * Conjunto de consultas para a tabela Quiz.
 *
 * @category QualiQuiz
 *
 * @author   Chicão Thiago <fthiagogv@gmail.com>
 * @license  GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link     https://github.com/EscolaDeSaudePublica/isus-api
 */
class AlternativaQuestaoRepository
{
    /**
     * Busca as alternativas para os ids das Questões.
     *
     * @param array $idsQuestoes
     *
     * @return mix
     */
    public function buscarAlternativasPelosIdsQuestoes(array $idsQuestoes)
    {
        return (new AlternativaQuestao())
            ->select(
                'id',
                'alternativa',
                'ordem',
                'questao_id'
            )
            ->whereIn('questao_id', $idsQuestoes)
            ->get();
    }
}
