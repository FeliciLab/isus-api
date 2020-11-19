<?php

declare(strict_mode=1);

namespace App\Domains\QualiQuiz\Service;

use App\Domains\QualiQuiz\Models\Resposta;
use App\Domains\QualiQuiz\Repository\QuizRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Contém a regra de negócio para salvar a resposta na base de dados.
 *
 * @category QualiQuiz
 *
 * @author   Chicão Thiago <fthiagogv@gmail.com>
 * @license  GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link     https://github.com/EscolaDeSaudePublica/isus-api
 */
class RespostaQuizService
{
    /**
     * Inicialize.
     */
    public function __construct()
    {
        $this->repository = new QuizRepository();
    }

    /**
     * Regra de negócio que salvar na base de dados a resposta.
     *
     * @param $respostas    Collection
     * @param $autenticacao Collection
     *
     * @return array
     */
    public function registrarRespostas(
        Collection $respostas,
        Collection $autenticacao
    ): array {
        $respostasInserir = [];

        foreach ($respostas as $resposta) {
            $validacao = $this
                ->repository
                ->buscarResposta(
                    $resposta['quizId'],
                    $resposta['questaoId'],
                    $resposta['alternativaId'],
                    $autenticacao->get('email')
                );

            if ($validacao) {
                return [
                    'msg' => 'Existem respostas já existente nas nossa'
                        . ' base de dados. Remova elas, ou verifica sua'
                        . ' consistência.',
                    'status' => 409,
                ];
            }

            $respostasInserir[] = [
                'questao_id' => $resposta['questaoId'],
                'quiz_id' => $resposta['quizId'],
                'questao_alternativa_id' => $resposta['alternativaId'],
                'identificacao' => $autenticacao->get('email'),
                'tipo_identificacao' => Resposta::DEFAULT_TYPE,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        if ($this->repository->salvarReposta($respostasInserir)) {
            return [
                'msg' => 'Salvo com sucesso.',
                'status' => 200,
            ];
        }

        return [
            'msg' => 'Houve falha ao salvar na base de dados.', 'status' => 400,
        ];
    }
}
