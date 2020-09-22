<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoriaProfissional extends Model
{
    const CATEGORIA_PROFISSIONAL_MEDICINA = 1;
    const CATEGORIA_PROFISSIONAL_ENFERMAGEM = 3;

    protected $table = 'categorias_profissionais';

    protected $hidden = ['created_at', 'updated_at'];

    public function especialidades()
    {
        return $this->hasMany(Especialidade::class, 'categoriaprofissional_id', 'id');
    }
}
