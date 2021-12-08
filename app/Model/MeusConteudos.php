<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MeusConteudos extends Model
{
    protected $table = 'meus_conteudos';
    protected $fillable = [
        'id',
        'imagem',
        'title',
        'link',
        'data',
        'ativo',
        'tipo_conteudo',
        'categoriaprofissional_id',
        'especialidade_id',
        'updated_at',
        'created_at'
    ];

    public function categoriaProfissional()
    {
        return $this->hasOne(CategoriaProfissional::class, 'id', 'categoriaprofissional_id');
    }

    public function especialidades()
    {
        return $this->hasOne(UserEspecialidade::class);
    }

    public function dadosMeusConteudos()
    {
        $categoriProfissional = $this->categoriaProfissional()->first();
        $especialidades = $this->especialidades()->first();

        $dadosMeusConteudos = [
            'id' => $this->id,
            'imagem' => $this->imagem,
            'title' => $this->title,
            'link' => $this->link,
            'data' => $this->data,
            'ativo' => $this->ativo,
            'tipo_conteudo' => $this->tipo_conteudo,
            'categoriaprofissional_id' => $categoriProfissional,
            'especialidade_id' => $especialidades
        ];

        return $dadosMeusConteudos;
    }

    public function remover()
    {
        return $this->delete();
    }
}
