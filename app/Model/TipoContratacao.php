<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoContratacao extends Model
{
    protected $table = 'tipo_contratacoes';

    protected $hidden = ['created_at', 'updated_at'];
}
