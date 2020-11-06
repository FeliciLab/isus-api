<?php

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resposta extends Model
{
    use SoftDeletes;

    const DEFAULT_TYPE = 'email';

    protected $table = 'qquiz_respostas';
    protected $fillable = [
        'id',
        'quiz_id',
        'questao_id',
        'questao_alternativa_id',
        'identificacao',
        'tipo_identificacao',
    ];

    public function quiz()
    {
        return $this->belongsTo('App\Domains\QualiQuiz\Models\Quiz');
    }

    public function questao()
    {
        return $this->belongsTo('App\Domains\QualiQuiz\Models\Questao');
    }

    public function alternativaQuestao()
    {
        return $this->belongsTo('App\Domains\QualiQuiz\Models\AlternativaQuestao');
    }
}
