<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserEspecialidade extends Model
{
    public $timestamps = false;
    protected $table = 'users_especialidades';

    public function especialidade()
    {
        return $this->hasOne(Especialidade::class, 'id', 'especialidade_id');
    }
}
