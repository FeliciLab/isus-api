<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para a tabela questoes.
 *
 * @category QualiQuiz
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api
 */
class Explicacao extends Model
{
    use SoftDeletes;

    protected $table = 'qquiz_explicacoes';
    protected $fillabel = [
        'alternativa_correta_id',
        'questao_id',
        'id',
        'descricao',
    ];

    /**
     * Relacionamento com a o modelo Resposta.
     *
     * @return mix
     */
    public function alternativa()
    {
        return $this->hasMany(
            'App\Domains\QualiQuiz\Models\AlternativaQuestao',
            'id',
            'alternativa_correta_id'
        );
    }

    /**
     * Relacionamento com a o modelo Resposta.
     *
     * @return mix
     */
    public function questao()
    {
        return $this->hasMany(
            'App\Domains\QualiQuiz\Models\Questao',
            'id',
            'questao_id'
        );
    }
}
