<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TitulacaoAcademica extends Model
{
    protected $table = 'titulacoes_academica';

    protected $hidden = ['created_at', 'updated_at'];
}
