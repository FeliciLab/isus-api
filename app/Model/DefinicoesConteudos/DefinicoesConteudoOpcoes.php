<?php

namespace App\Model\DefinicoesConteudos;

use Illuminate\Database\Eloquent\Model;

class DefinicoesConteudoOpcoes extends Model
{
    protected $table = 'definicoes_conteudos_opcoes';

    protected $fillable = [
        'chave',
        'valor',
        'definicoes_conteudos_id',
        'created_at',
        'updated_at',
    ];

    protected $cast = [
        'chave' => 'string',
        'valor' => 'string',
        'definicoes_conteudos_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function definicoesConteudo()
    {
        return $this->belongsTo(DefinicoesConteudo::class);
    }
}
