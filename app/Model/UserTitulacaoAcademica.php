<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserTitulacaoAcademica extends Model
{
    public $timestamps = false;
    protected $table = 'users_titulacoes_academicas';

    public function titulacaoAcademica()
    {
        return $this->hasOne(TitulacaoAcademica::class);
    }
}
