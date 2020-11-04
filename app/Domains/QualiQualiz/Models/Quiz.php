<?php
declare(strict_types = 1);

namespace App\Domains\QualiQualiz\Models;

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
        return $this->hasMany('App\Domains\QualiQualiz\Models\Resposta');
    }

    public function quizQuestoes()
    {
        return $this->belongsToMany('App\Domains\QualiQualiz\Models\QuizQuestao');
    }
}
