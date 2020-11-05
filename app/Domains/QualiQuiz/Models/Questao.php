<?php

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questao extends Model
{
    use SoftDeletes;

    protected $table = 'qquiz_questoes';
    protected $fillable = [
        'questao',
        'url_imagem',
    ];

    protected $cast = [
        'questao' => 'string',
        'url_imagem' => 'string',
    ];

    public function alternativasQuestao()
    {
        return $this->hasMany('App\Domains\QualiQuiz\Models\AlterrnativaQuestao');
    }

    public function respostas()
    {
        return $this->hasMany('App\Domains\QualiQuiz\Models\Resposta');
    }

    public function quiz()
    {
        return $this->belongsToMany(
            'App\Domains\QualiQuiz\Models\Quiz',
            'qquiz_quiz_questoes',
            'questao_id',
            'quiz_id'
        );
    }
}
