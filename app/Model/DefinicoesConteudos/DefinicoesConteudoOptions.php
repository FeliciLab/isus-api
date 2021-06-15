<?php

namespace App\Model\DefinicoesConteudo;

use Illuminate\Database\Eloquent\Model;

class DefinicoesConteudoOpcoes extends Model
{
    protected $table = 'definicoes_conteudos_opcoes';

    protected $fillable = [
        'chave',
        'valor',
        'definicoes_conteudo_id',
        'created_at',
        'updated_at'
    ];

    protected $cast = [
        'chave' => 'string',
        'valor' => 'string',
        'definicoes_conteudo_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function definicoesConteudo()
    {
        return $this->belongsTo(DefinicoesConteudo::class);
    }
}