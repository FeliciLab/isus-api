<?php

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para a tabela questoes.
 *
 * @category QualiQuiz
 *
 * @author   Chicão Thiago <fthiagogv@gmail.com>
 * @license  GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link     https://github.com/EscolaDeSaudePublica/isus-api
 */
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

    /**
     * Relacionamento com a o modelo AlternativaQuestao.
     *
     * @return mix
     */
    public function alternativasQuestao()
    {
        return $this->hasMany(
            'App\Domains\QualiQuiz\Models\AlterrnativaQuestao'
        );
    }

    /**
     * Relacionamento com a o modelo Resposta.
     *
     * @return mix
     */
    public function respostas()
    {
        return $this->hasMany(
            'App\Domains\QualiQuiz\Models\Resposta'
        );
    }

    /**
     * Relacionamento com a o modelo Quiz.
     *
     * @return mix
     */
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
