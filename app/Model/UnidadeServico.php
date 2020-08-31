<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UnidadeServico extends Model
{
    protected $table = 'unidades_servico';

    protected $hidden = ['created_at', 'updated_at'];
}
