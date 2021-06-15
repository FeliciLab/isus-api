<?php

namespace App\Model\DefinicoesConteudo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefinicoesConteudo extends Model
{
    use HasFactory;

    protected $table = 'definicoes_conteudos';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'ativo',
        'categorias',
        'imagem',
        'opcoes',
        'ordem',
        'sessao',
        'valor',
        'tipo',
        'titulo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'ordem' => 'integer',
        'opcoes' => 'json',
    ];

    public function opcoes()
    {
        return $this->hasMany(DefinicoesConteudoOpcoes::class);
    }
}
