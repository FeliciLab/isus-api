<?php

namespace App\Domains\QualiQualiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlterrnativaQuestao extends Model
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
        return $this->belongsTo('App\Domains\QualiQualiz\Models\Questao');
    }

    public function respostas()
    {
        return $this->hasMany('App\Domains\QualiQualiz\Models\Respota');
    }
}
