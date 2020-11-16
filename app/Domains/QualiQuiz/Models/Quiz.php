<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    protected $table = 'qquiz_quiz';
    protected $fillabel = [
        'nome',
    ];

    protected $cast = [
        'nome' => 'string',
    ];

    public function respostas()
    {
        return $this->hasMany('App\Domains\QualiQuiz\Models\Resposta');
    }

    public function questoes()
    {
        return $this->belongsToMany(
            'App\Domains\QualiQuiz\Models\Questao',
            'qquiz_quiz_questoes',
            'quiz_id',
            'questao_id'
        );
    }
}
