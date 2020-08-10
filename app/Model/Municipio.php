<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';

    public function estado()
    {
        return $this->hasOne(Estado::class, 'id', 'estado_id');
    }
}
