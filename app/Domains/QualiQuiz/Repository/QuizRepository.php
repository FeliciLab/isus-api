<?php

declare(strict_mode=1);

namespace App\Domains\QualiQuiz\Repository;

use App\Domains\QualiQuiz\Models\Quiz;
use App\Domains\QualiQuiz\Models\Resposta;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

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
class QuizRepository
{
    /**
     * Busca na base o quiz pelo id.
     *
     * @param int $codQuiz
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

    /**
     * Busca a resposta para um determinado usuário.
     *
     * @param $quizId        int
     * @param $questaoId     int
     * @param $alternativaId int
     * @param $identificador string
     *
     * @return Resposta|null
     */
    public function buscarResposta(
        int $quizId,
        int $questaoId,
        int $alternativaId,
        string $identificador
    ) {
        return Resposta::where('quiz_id', $quizId)
            ->where('questao_id', $questaoId)
            ->where('questao_alternativa_id', $alternativaId)
            ->where('identificacao', $identificador)
            ->first();
    }

    /**
     * Salva a resposta na base.
     *
     * @param Collection $respostas
     * @param Collection $autenticacao
     */
    public function registrarRespostas(Collection $respostas, Collection $autenticacao): array
    {
        $respostasInserir = [];

        foreach ($respostas as $resposta) {
            if ($this->buscarResposta(
                $resposta['quizId'],
                $resposta['questaoId'],
                $resposta['alternativaId'],
                $autenticacao->get('email')
            )) {
                return [
                    'msg' => 'Existem respostas já existente nas nossa base de dados. Remova elas, ou verifica sua consistência.',
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

        $ok = Resposta::insert($respostasInserir);

        if ($ok) {
            return ['msg' => 'Salvo com sucesso.', 'status' => 200];
        }

        return ['msg' => 'Houve falha ao salvar na base de dados.', 'status' => 400];
    }

    /**
     * @param array $respostasInserir
     */
    public function salvarReposta(array $respostasInserir)
    {
        return Resposta::insert($respostasInserir);
    }
}
