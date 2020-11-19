<?php

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para a tabela quiz_questoes.
 *
 * @category QualiQuiz
 *
 * @author   Chicão Thiago <fthiagogv@gmail.com>
 * @license  GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link     https://github.com/EscolaDeSaudePublica/isus-api
 */
class QuizQuestao extends Model
{
    use SoftDeletes;

    protected $table = 'qquiz_quiz_questoes';

    protected $fillable = [
        'ordem',
        'quiz_id',
        'questao_id',
    ];

    /**
     * Relacionamento com o modelo Quiz.
     *
     * @return mix
     */
    public function quiz()
    {
        return $this->belongsToMany(
            'App\Domains\QualiQuiz\Models\Quiz'
        );
    }

    /**
     * Relacionamento com o modelo Questao.
     *
     * @return mix
     */
    public function questoes()
    {
        return $this->belongsToMany(
            'App\Domains\QualiQuiz\Models\Questao'
        );
    }
}
