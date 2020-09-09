<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoriaProfissional extends Model
{
    protected $table = 'categorias_profissionais';

    protected $hidden = ['created_at', 'updated_at'];
}
