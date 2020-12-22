<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Controllers;

use App\Domains\QualiQuiz\Service\BuscarQuizService;
use App\Domains\QualiQuiz\Service\FeedbackQuizService;
use App\Domains\QualiQuiz\Utils\JWTDecoder;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Classe controller para rotas de busca do quiz.
 *
 * @category Qualiquiz
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api/issues/120
 */
class BuscarQuizController extends Controller
{
    /**
     * Busca o quiz a partir do código id do quiz.
     *
     * @param $request             Request
     * @param $buscarQuizService   BuscarQuizService
     * @param $feedbackQuizService FeedbackQuizService
     * @param $jwtDecoder          JWTDecoder
     * @param $codQuiz             Int
     *
     * @return JsonResponse
     */
    public function buscarQuiz(
        Request $request,
        BuscarQuizService $buscarQuizService,
        FeedbackQuizService $feedbackQuizService,
        JWTDecoder $jwtDecoder,
        string $codQuiz
    ): JsonResponse {
        if (!$request->header('Authorization')) {
            return response()->json(['mensagem' => 'Token não enviado'], 401);
        }

        $autenticacao = $jwtDecoder->decoderPayload(
            $request->header('Authorization')
        );

        if (Validator::make($autenticacao->toArray(), ['email' => 'required'])->fails()) {
            return response()->json(['mensagem' => 'Token inválido'], 400);
        }

        if (!is_numeric($codQuiz) && is_float((float) $codQuiz)) {
            return response()->json(
                ['mensagem' => 'Código do quiz não é um valor numérico inteiro'],
                400
            );
        }

        if ($buscarQuizService->verificarSeJaRespondeu((int) $codQuiz, $autenticacao)
            && env('QQUIZ_BLOQUEAR_REFAZER')
        ) {
            return response()->json(
                [
                    'resultado' => $feedbackQuizService->buscarResultado(
                        (int) $codQuiz,
                        $autenticacao
                    ),
                    'comentarioQuestoes' => $feedbackQuizService
                        ->buscarExplicacoesQuestoesQuiz(
                            (int) $codQuiz
                        ),
                ]
            );
        }

        return response()->json(
            $buscarQuizService->buscarQuizCompleto((int) $codQuiz)
        );
    }
}
