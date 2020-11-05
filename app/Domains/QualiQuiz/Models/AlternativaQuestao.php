<?php

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlternativaQuestao extends Model
{
    use SoftDeletes;

    protected $table = 'qquiz_alternativas_questoes';

    protected $fillabel = [
        'id',
        'alternativa',
        'url_imagem',
        'pontuacao',
        'questao_id',
        'ordem',
    ];

    public function questao()
    {
        return $this->belongsTo('App\Domains\QualiQuiz\Models\Questao');
    }

    public function respostas()
    {
        return $this->hasMany('App\Domains\QualiQuiz\Models\Respota');
    }
}
