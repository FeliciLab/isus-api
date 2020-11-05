<?php
declare(strict_types = 1);

namespace App\Domains\QualiQuiz\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\QualiQuiz\Repository\QuizRepository.php

class BuscarQuizController extends Controller
{
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
