<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Service;

use App\Domains\QualiQuiz\Repository\ExplicacoesRepository;
use App\Domains\QualiQuiz\Repository\RespostaRepository;
use Illuminate\Support\Collection;

/**
 * Classe responsável pela regra de negócio do feedback.
 *
 * @category Service
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api/issues/125
 */
class FeedbackQuizService
{
    /**
     * Busca a pontuacao da pessoa no quiz.
     *
     * @param $idQuiz       int
     * @param $autenticacao Collection
     *
     * @return Collection
     */
    public function buscarResultado(int $idQuiz, Collection $autenticacao): Collection
    {
        return (new RespostaRepository)
            ->buscarResultado($idQuiz, $autenticacao->get('email'));
    }

    /**
     * Buscar os as explicacoes das questoes.
     *
     * @param $idQuiz int
     *
     * @return Collection
     */
    public function buscarExplicacoesQuestoesQuiz(int $idQuiz): Collection
    {
        return (new ExplicacoesRepository)->buscarExplicacoesDoQuiz($idQuiz);
    }
}
