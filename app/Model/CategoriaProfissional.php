<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoriaProfissional extends Model
{
    public const CATEGORIA_PROFISSIONAL_MEDICINA = 1;
    public const CATEGORIA_PROFISSIONAL_ENFERMAGEM = 3;

    protected $table = 'categorias_profissionais';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'nome',
        'id',
        'ordem',
    ];

    public function especialidades()
    {
        return $this->hasMany(Especialidade::class, 'categoriaprofissional_id', 'id');
    }
}
