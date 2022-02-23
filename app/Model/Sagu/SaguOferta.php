<?php

namespace App\Model\Sagu;

use Illuminate\Database\Eloquent\Model;

class SaguOferta extends Model
{
    protected $table = 'sagu_ofertas';

    protected $fillable = [
        'nome',
        'carga_horaria',
        'is_active',
        'inicio',
        'fim',
    ];
}
