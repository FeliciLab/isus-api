<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserUnidadeServico extends Model
{
    public $timestamps = false;
    protected $table = 'users_unidades_servicos';

    public function unidadeServico()
    {
        return $this->hasOne(UnidadeServico::class, 'id', 'unidade_servico_id');
    }
}
