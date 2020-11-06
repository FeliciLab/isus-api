<?php
declare(strict_types = 1);


namespace App\Domains\QualiQuiz\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Domains\QualiQuiz\Repository\QuizRepository;
use App\Domains\QualiQuiz\Utils\JWTDecoder;

class RespostasQuizController extends Controller
{
    /**
     * Recebe um json com o formato:
     * {
     *    "respostas": [
     *      {
     *        "quizId": "number",
     *        "questaoId": "number",
     *        "alternativaId": "number",
     *      }
     *    ]
     * }
     */
    public function registrar(Request $request, JWTDecoder $jwtDecoder, QuizRepository $quizRepository)
    {
        if (!$request->header('Authorization')) {
            return response()->json(['message' => 'Token não enviado'], 403 );
        }

        $autenticacao = $jwtDecoder->decoderPayload($request->header('Authorization'));
        if (Validator::make($autenticacao->toArray(), ['email' => 'required'])->fails()) {
            return response()->json(['message' => 'Token inválido'], 403);
        }

        $validacao = Validator::make($request->all(), [
            'respostas' => 'required',
            'respostas.*.quizId' => 'required',
            'respostas.*.questaoId' => 'required',
            'respostas.*.alternativaId' => 'required',
        ]);

        if ($validacao->fails()) {
            return response()->json(['message' => $validacao->errors()->toArray()], 400);
        }

        $resultado = $quizRepository->registrarRespostas(collect($request->respostas), $autenticacao);
        return response()->json(
            ['message' => $resultado['msg']],
            $resultado['status']
        );
    }
}
