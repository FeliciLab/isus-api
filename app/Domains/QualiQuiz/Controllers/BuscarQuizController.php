<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\QualiQuiz\Repository\QuizRepository;

/**
 * Classe controller para rotas de busca do quiz
 *
 * @category Qualiquiz
 * @package  Domain\Qualiquiz
 * @author   Chicão Thiago <fthiagogv@gmail.com>
 * @license  GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link     https://github.com/EscolaDeSaudePublica/isus-api/issues/120
 */
class BuscarQuizController extends Controller
{
    /**
     * Busca o quiz a partir do código id do quiz
     *
     * @param $request        Request
     * @param $quizRepository QuizRepository
     * @param $codQuiz        Int
     *
     * @return mix
     */
    public function buscarQuiz(
        Request $request,
        QuizRepository $quizRepository,
        int $codQuiz
    ) {
        return response()->json(
            $quizRepository->buscarQuizCompleto($codQuiz),
            200
        );
    }
}
