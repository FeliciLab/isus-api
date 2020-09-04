<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserTipoContratacao extends Model
{
    public $timestamps = false;
    protected $table = 'users_tipos_contratacoes';

    public function tipoContratacao()
    {
        return $this->hasOne(TipoContratacao::class);
    }
}
