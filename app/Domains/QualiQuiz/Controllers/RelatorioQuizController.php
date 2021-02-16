<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Controllers;

use App\Domains\QualiQuiz\Service\RelatorioQuizService;
use App\Http\Controllers\Controller;

/**
 * Classe controller para rotas de busca do quiz.
 *
 * @category Qualiquiz
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api/issues/137
 */
class RelatorioQuizController extends Controller
{
    /**
     * Gera relatório de todos os quiz e respostas salvas na base.
     *
     * @param RelatorioQuizService $relatorioQuizService classe service
     *
     * @return File
     */
    public function todasRespostasQuiz(RelatorioQuizService $relatorioQuizService)
    {
        $fileName = 'Relatorio respostas quiz - ' . date('d-m-Y H:i:s') . '.csv';

        return response()->streamDownload(
            $relatorioQuizService->callbackGerarRelatorioQuizRespostasTudo(),
            $fileName,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=$fileName",
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0',
            ]
        );
    }

    /**
     * Gera relatório de todos os quiz e respostas salvas na base.
     *
     * @param string               $codQuiz              Código do quiz
     * @param RelatorioQuizService $relatorioQuizService classe service
     *
     * @return File
     */
    public function respostasCodQuiz(
        string $codQuiz,
        RelatorioQuizService $relatorioQuizService
    ) {
        $fileName = "Relatorio respostas quiz $codQuiz - " . date('d-m-Y H:i:s') . '.csv';

        return response()->streamDownload(
            $relatorioQuizService->gerarRelatorioQuizRespostasPeloCodQuiz($codQuiz),
            $fileName,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=$fileName",
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0',
            ]
        );
    }
}
