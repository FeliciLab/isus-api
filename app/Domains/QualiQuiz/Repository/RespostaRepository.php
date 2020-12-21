<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Repository;

use App\Domains\QualiQuiz\Models\Resposta;
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
     * Verifica se há alguma resposta para a usuária na base de dados.
     *
     * @param $quizId        int
     * @param $identificador string
     *
     * @return bool
     */
    public function verificaSeJaRespondeu(int $quizId, string $identificador): bool
    {
        return Resposta::select('id')
            ->where('quiz_id', $quizId)
            ->where('identificacao', $identificador)
            ->first() !== null;
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

    /**
     * Função que consulta a pontuacao da pessoa.
     *
     * @param $idQuiz        int
     * @param $identificacao string
     *
     * @return Collection
     */
    public function buscarResultado(int $idQuiz, string $identificacao): Collection
    {
        return collect(
            DB::table('qquiz_respostas as qr')
                ->selectRaw(
                    'SUM(CASE WHEN qaq.id = qr.questao_alternativa_id THEN 1 ELSE 0 END) as acertos,
                    SUM(CASE WHEN qaq.id = qr.questao_alternativa_id THEN 0 ELSE 1 END) as erros,
                    (SUM(CASE WHEN qaq.id = qr.questao_alternativa_id THEN 1 ELSE 0 END)/COUNT(qqq.questao_id))*100 as percentagem,
                    SUM(qr.tempo) as tempo,
                    COUNT(qqq.questao_id) as num_questoes'
                )
                ->rightJoin(
                    'qquiz_quiz_questoes as qqq',
                    function ($join) use ($identificacao) {
                        $join->on('qr.questao_id', '=', 'qqq.questao_id')
                            ->where('qr.identificacao', '=', $identificacao);
                    }
                )
                ->join(
                    'qquiz_alternativas_questoes as qaq',
                    function ($join) {
                        $join->on('qaq.questao_id', '=', 'qqq.questao_id')
                            ->where('qaq.pontuacao', '=', 100);
                    }
                )
                ->where('qqq.quiz_id', '=', $idQuiz)
                ->first()
        );
    }
}
