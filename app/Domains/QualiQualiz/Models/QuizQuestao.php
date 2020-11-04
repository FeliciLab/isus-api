<?php

namespace App\Domains\QualiQualiz\Models;

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
        return $this->belongsToMany('App\Domains\QualiQualiz\Models\Quiz');
    }

    public function questoes()
    {
        return $this->belongsToMany('App\Domains\QualiQualiz\Models\Questao');
    }
}
