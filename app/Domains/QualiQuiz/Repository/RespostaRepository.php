<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Repository;

use App\Domains\QualiQuiz\Models\Resposta;

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
class RespostaRepository
{
    /**
     * Busca a resposta para um determinado usuário.
     *
     * @param int    $quizId        ID do quiz
     * @param int    $questaoId     ID da questão
     * @param string $identificador valor identificador, incialmente e-mail
     *
     * @return Resposta|null
     */
    public function verificarRespostaExiste(
        int $quizId,
        int $questaoId,
        string $identificador
    ) {
        return Resposta::select('id')
            ->where('quiz_id', $quizId)
            ->where('questao_id', $questaoId)
            ->where('identificacao', $identificador)
            ->first();
    }

    /**
     * Função para salvar um conjunto de respsotas no banco.
     *
     * @param array $respostasInserir Lista de respostas para salvar
     *
     * @return bool
     */
    public function salvarReposta(array $respostasInserir)
    {
        return Resposta::insert($respostasInserir);
    }
}
