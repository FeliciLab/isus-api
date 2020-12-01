<?php

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para a tabela alternativa_questoes.
 *
 * @category QualiQuiz
 *
 * @author   Chicão Thiago <fthiagogv@gmail.com>
 * @license  GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link     https://github.com/EscolaDeSaudePublica/isus-api
 */
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

    /**
     * Relacionamento com o modelo Questão.
     *
     * @return mix
     */
    public function questao()
    {
        return $this->belongsTo('App\Domains\QualiQuiz\Models\Questao');
    }

    /**
     * Relacionamento com o modelo/tabela resposta.
     *
     * @return mix
     */
    public function respostas()
    {
        return $this->hasMany('App\Domains\QualiQuiz\Models\Respota');
    }
}
