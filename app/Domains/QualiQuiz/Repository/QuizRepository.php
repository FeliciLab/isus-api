<?php

declare(strict_mode=1);

namespace App\Domains\QualiQuiz\Repository;

use App\Domains\QualiQuiz\Models\AlternativaQuestao;
use App\Domains\QualiQuiz\Models\Questao;
use App\Domains\QualiQuiz\Models\Quiz;
use App\Domains\QualiQuiz\Models\QuizQuestao;
use Illuminate\Support\Collection;

class QuizRepository
{
    public function buscarQuizCompleto(int $codQuiz): Collection
    {
        $quiz = (new Quiz())->select('id', 'nome')->where('id', $codQuiz)->first();

        $quizQuestoes = (new QuizQuestao())
            ->select('ordem', 'questao_id')
            ->where('quiz_id', $quiz->id)
            ->get()
            ->keyBy('questao_id');

        $questoes = (new Questao())
            ->select('id', 'questao')
            ->whereIn('id', $quizQuestoes->map(function ($item) {
                return $item->questao_id;
            }))
            ->get();

        $alternativas = (new AlternativaQuestao())
            ->select('alternativa', 'ordem', 'questao_id')
            ->whereIn('questao_id', $questoes->map(function ($item) {
                return $item->id;
            }))
            ->get();

        return collect([
            'quiz' => $quiz->nome,
            'questoes' => $questoes->map(function ($questao) use ($quizQuestoes, $alternativas) {
                return [
                    'ordem' => $quizQuestoes->get($questao->id)->ordem,
                    'questao' => $questao->questao,
                    'alternativas' => $alternativas->filter(function ($alternativa) use ($questao) {
                        return $alternativa->questao_id === $questao->id;
                    })->map(function ($item) {
                        return [
                            'alternativa' => $item->alternativa,
                            'ordem' => $item->ordem,
                        ];
                    }),
                ];
            }),
        ]);
    }
}
