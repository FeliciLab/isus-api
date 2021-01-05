<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Repository;

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
class RelatorioQuizRepository
{
    /**
     * Escopo da consulta para gerar o relatório.
     *
     * @return mix
     */
    public function escopoBuscarRelatorioRespostas()
    {
        return DB::table('qquiz_respostas as qr')
            ->selectRaw(
                'qr.identificacao as identificacao,
                qq.cod_quiz as cod_quiz,
                qqq.ordem as questao,
                Char(64 + qaq.ordem) as opcao_marcada,
                CASE WHEN qr.questao_alternativa_id = qaq.id THEN \'ACERTOU\' ELSE \'ERROU\' END as acerto,
                qr.created_at as data_resposta'
            )
            ->join('qquiz_quiz as qq', 'qq.id', '=', 'qr.quiz_id')
            ->rightJoin(
                'qquiz_quiz_questoes as qqq',
                'qr.questao_id',
                '=',
                'qqq.questao_id'
            )
            ->join(
                'qquiz_alternativas_questoes as qaq',
                function ($join) {
                    $join->on('qaq.questao_id', '=', 'qqq.questao_id')
                        ->where('qaq.pontuacao', '=', 100);
                }
            );
    }

    /**
     * Busca as respostas para todos os quiz.
     *
     * @return array
     */
    public function buscarTudoRelatorioRespostas()
    {
        return $this->escopoBuscarRelatorioRespostas()->get();
    }

    /**
     * Busca as respostas um determinado quiz baseado no seu código.
     *
     * @param string $codQuiz Código do quiz
     *
     * @return array
     */
    public function buscarRelatorioRespostarCodQuiz(string $codQuiz)
    {
        return $this->escopoBuscarRelatorioRespostas()
            ->where('qq.cod_quiz', $codQuiz)
            ->get();
    }
}
