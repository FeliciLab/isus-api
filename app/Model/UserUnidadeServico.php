<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserUnidadeServico extends Model
{
    protected $table = 'users_unidades_servicos';

    public $timestamps = false;

    public function unidadeServico()
    {
        return $this->hasOne(UnidadeServico::class);
    }
}
