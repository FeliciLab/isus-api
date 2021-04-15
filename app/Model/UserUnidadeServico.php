<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserUnidadeServico extends Model
{
    public $timestamps = false;
    protected $table = 'users_unidades_servicos';

    protected $fillable = [
        'id',
        'user_id',
        'unidade_servico_id',
    ];

    public function unidadeServico()
    {
        return $this->hasOne(UnidadeServico::class, 'id', 'unidade_servico_id');
    }
}
