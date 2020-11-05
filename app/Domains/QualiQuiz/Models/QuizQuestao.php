<?php

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizQuestao extends Model
{
    use SoftDeletes;

    protected $table = 'qquiz_quiz_questoes';

    protected $fillable = [
        'ordem',
        'quiz_id',
        'questao_id',
    ];

    public function quiz()
    {
        return $this->belongsToMany('App\Domains\QualiQuiz\Models\Quiz');
    }

    public function questoes()
    {
        return $this->belongsToMany('App\Domains\QualiQuiz\Models\Questao');
    }
}
