<?php
declare(strict_mode=1);

namespace App\Domains\QualiQuiz\Repository;

use App\Domains\QualiQuiz\Models\Quiz;

class QuizRepository
{
    public function buscarQuizCompleto(int $codQuiz): array
    {
        $quiz = [];
        dd(
            (new Quiz())->where('id', 1)
                ->first()
        );
        return $quiz;
    }
}
