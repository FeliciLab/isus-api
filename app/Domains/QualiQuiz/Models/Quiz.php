<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para a tabela quiz.
 *
 * @category QualiQuiz
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api
 */
class Quiz extends Model
{
    use SoftDeletes;

    protected $table = 'qquiz_quiz';
    protected $fillabel = [
        'cod_quiz',
        'nome',
        'tempo_limite',
        'area_tematica',
        'publico_alvo',
        'descricao',
    ];

    protected $cast = [
        'nome' => 'string',
        'tempo_limite' => 'integer',
        'area_tematica' => 'string',
        'publico_alvo' => 'string',
        'descricao' => 'string',
    ];

    /**
     * Relacionamento com o modelo Resposta.
     *
     * @return mix
     */
    public function respostas()
    {
        return $this->hasMany('App\Domains\QualiQuiz\Models\Resposta');
    }

    /**
     * Relacionamento com o modelo Questoes.
     *
     * @return mix
     */
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
