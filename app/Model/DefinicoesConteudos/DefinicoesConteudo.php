<?php

namespace App\Model\DefinicoesConteudos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefinicoesConteudo extends Model
{
    use HasFactory;

    protected $table = 'definicoes_conteudos';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'ativo',
        'categoria',
        'imagem',
        'ordem',
        'sessao',
        'tipo',
        'titulo',
        'valor',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'ordem' => 'integer',
    ];

    public function opcoes()
    {
        return $this->hasMany(
            DefinicoesConteudoOpcoes::class,
            'definicoes_conteudos_id', 'id'
        );
    }
}
