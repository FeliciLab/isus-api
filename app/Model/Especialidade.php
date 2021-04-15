<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $table = 'especialidades';
    protected $fillable = [
        'nome',
        'categoriaprofissional_id',
        'id',
    ];
}
